<?php

namespace App\Notifications;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPaymentToConfirm extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Payment $payment
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Nuevo pago por confirmar')
                    ->line('Hay un nuevo pago por confirmar')
                    ->line('Refrencia: ' . $this->payment->reference)
                    ->line('Monto: $ ' . $this->payment->amount_dollar)
                    ->action('Ver pagos', url('/administrador/pago?status=Pendiente'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'reference' => $this->payment->reference,
            'amount_dollar' => $this->payment->amount_dollar,
        ];
    }
}
