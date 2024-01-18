<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class joinTeam extends Notification
{
    use Queueable;
    private $useradd;
    private $teamname;
    private $datejoin;
    private $useradding;
    /**
     * Create a new notification instance.
     */
    public function __construct($useradd, $teamname, $date, $useradding)
    {
        $this->useradd = $useradd;
        $this->teamname = $teamname;
        $this->datejoin = $date;
        $this->useradding = $useradding;
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
                    ->line(__('notif.joinTeam.mail.NotifNew'))
                    ->line(__('notif.joinTeam.database.userAdded')."".$this->useradd)
                    ->line(__('notif.joinTeam.database.userAdding')."".$this->useradding)
                    ->line(__('notif.joinTeam.database.TeamJoin')."".$this->teamname)
                    ->line(__('notif.joinTeam.database.date')."".$this->datejoin)
                    ->line(__('notif.joinTeam.mail.goodbye'));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user' => $this->useradd,
            'team' => $this->teamname,
            'date' => $this->datejoin,
        ];
    }
}
