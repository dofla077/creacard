<?php

namespace App\Notifications;

use App\Enums\QuotationState;
use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserNotifyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    const SUBJECT = 'The Response of quotation ';

    /**
     * The quotation instance.
     *
     * @var Quotation
     */
    public Quotation $quotation;

    /**
     * @var QuotationState
     */
    public QuotationState $state;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Quotation $quotation, QuotationState $state)
    {
        $this->quotation = $quotation;
        $this->state = $state;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $number = $this->quotation->number;
        return (new MailMessage)
            ->subject(static::SUBJECT . $number)
                    ->line('The customer ' . $this->quotation->customer->name)
                    ->line($this->state->value . ' the quotation number ' . $number)
                    ->line('Thank you for using our application!');
    }
}
