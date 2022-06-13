<?php

namespace App\Notifications;

use App\Enums\QuotationState;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class QuotationCustomerNotification extends Notification implements ShouldQueue
{
    use Queueable;

    const SUBJECT = 'Quotation number';
    const INTRO = 'You can found on this mail your quotation';

    protected Quotation $quotation;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation)
    {
        $this->quotation = $quotation;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(static::SUBJECT . ': ' . $this->quotation->number)
            ->markdown('mail.quotation', [
                'seller' => $this->quotation->customer->user,
                'customer' => $this->quotation->customer,
                'quotation' => $this->quotation,
                'description' => $this->quotation->description,
                'intro' => static::INTRO,
                QuotationState::Accept->value => [
                    'url' => url(
                        route('quotations.customer.choice', [$this->quotation, QuotationState::Accept->value])
                    ),
                    'value' => QuotationState::Accept->value
                ],
                QuotationState::Reject->value => [
                    'url' => url(
                        route('quotations.customer.choice', [$this->quotation, QuotationState::Reject->value])
                    ),
                    'value' => QuotationState::Reject->value
                ],
            ]);
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param mixed $notifiable
     * @param string $channel
     * @return bool
     */
    public function shouldSend($notifiable, $channel): bool
    {
        $isSend = $this->quotation->isPending();
        if ($isSend && !$this->quotation->sended_at) {
            $this->quotation->sended_at = now();
            $this->quotation->save();

            return true;
        }

        return false;
    }
}
