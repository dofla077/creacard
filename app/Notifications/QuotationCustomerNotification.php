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
            ->subject('Quotation number: ' . $this->quotation->number)
            ->line('The introduction to the notification.')
            ->markdown('mail.quotation', [
                QuotationState::Accept->value => [
                    'url' => url(route('quotations.return', [$this->quotation, QuotationState::Accept->value])),
                    'value' => QuotationState::Accept->value
                ],
                QuotationState::Reject->value => [
                    'url' => url(route('quotations.return', [$this->quotation, QuotationState::Reject->value])),
                    'value' => QuotationState::Reject->value
                ],
            ])
            ->line('Thank you for using our application!');
    }

    /**
     * Determine if the notification should be sent.
     *
     * @param mixed $notifiable
     * @param string $channel
     * @return bool
     */
    public function shouldSend($notifiable, $channel)
    {
        return $this->quotation->isSend();
    }
}
