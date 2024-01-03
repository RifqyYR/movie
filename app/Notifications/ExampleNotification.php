<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;
use Telegram\Bot\Laravel\Facades\Telegram;

class ExampleNotification extends Notification
{
    use Queueable;

    private $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [Telegram::class];
    }

    public function toTelegram($notifiable)
    {
        return Telegram::bot(config('services.telegram-bot-api.name', 'mybot'))->sendMessage([
            'chat_id' => $notifiable->telegram_chat_id,
            'text' => $this->message,
        ]);
    }
}
