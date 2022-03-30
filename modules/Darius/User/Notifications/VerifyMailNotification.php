<?php

namespace Darius\User\Notifications;

use Darius\User\Mail\VerifyCodeMail;
use Darius\User\Services\VerifyCodeService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Psr\SimpleCache\InvalidArgumentException;

class VerifyMailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
     * @param mixed $notifiable
     * @return VerifyCodeMail
     * @throws Exception|InvalidArgumentException
     */
    public function toMail($notifiable): VerifyCodeMail
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code, now()->addDay());
        return (new VerifyCodeMail($code))->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable): array
    {
        return [
            //
        ];
    }
}
