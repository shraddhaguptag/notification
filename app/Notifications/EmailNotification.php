<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\NotificationTemplate;
use Illuminate\Support\HtmlString;

class EmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    /**
     * @var array $project
     */
    protected $template;

    /**
     * @method constructor for Create a new notification instance.
     * @return
     * @param NotificationTemplate $template
     */
    public function __construct($template)
    {
        $this->template = $template;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $notificationTemplate = NotificationTemplate::orderBy('id', 'desc')->first();

        return (new MailMessage)

            //->line($this->template['body'])
            ->line(new HtmlString($this->template['body']))
            ->subject($this->template['subject']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'template' => $this->template['id']
        ];
    }
}
