<?php

namespace App\Notifications;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramFile;

final class PostPublished extends Notification
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
     * @param mixed $notifiable
     * @return array
     */
    public function via(Post $notifiable): array
    {
        return ['telegram'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail(Post $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray(Post $notifiable): array
    {
        return [
            //
        ];
    }

    public function toTelegram(Post $notifiable): TelegramFile
    {
        return TelegramFile::create()
            ->to(config('services.telegram-bot-api.chat_id'))
            ->content(
                '*' . $notifiable->name . '* ' . PHP_EOL . $notifiable->preview_text . PHP_EOL . ' [' . trans(
                    'posts.index.read_more'
                ) . '](' . route(
                    'site.posts.show',
                    ['slug' => $notifiable->slug]
                ) . ')'
            )
            ->file($notifiable->image_path, 'photo');
    }
}
