<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceSendNotification extends Notification
{
    use Queueable;

    /**
     * The quotation instance.
     *
     * @var Invoice
     */
    public Invoice $invoice;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invoice $invoice)
    {
        $this->invoice = $invoice->load('quotation.customer.user');
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
            ->subject('Invoice number: ' . $this->invoice->number)
            ->markdown('mail.invoice', [
                'seller' => $this->invoice->quotation->customer->user,
                'customer' => $this->invoice->quotation->customer,
                'quotation' => $this->invoice->quotation,
                'invoice' => $this->invoice,
            ]);
    }
}
