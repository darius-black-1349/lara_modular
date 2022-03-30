<?php

namespace Darius\User\Notifications;

use Darius\User\Mail\ResetPasswordRequestMail;
use Darius\User\Services\VerifyCodeService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Psr\SimpleCache\InvalidArgumentException;

class ResetPasswordRequestNotification extends Notification
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


    public function toMail($notifiable): ResetPasswordRequestMail
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code, 120);
        return (new ResetPasswordRequestMail($code))->to($notifiable->email);
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
