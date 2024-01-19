<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class ExampleNotification extends Notification
{
    use Queueable;

    private $message;
    private $groupId;

    /**
     * Create a new notification instance.
     */
    public function __construct(string $message, $groupId)
    {
        $this->message = $message;
        $this->groupId = $groupId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    public function toTelegram($notifiable)
    {
        return TelegramMessage::create()
            ->to($this->groupId)
            ->content($this->message);
    }
}
