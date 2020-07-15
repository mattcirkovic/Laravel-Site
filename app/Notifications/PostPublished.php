<?php


namespace App\Notifications;

use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use NotificationChannels\FacebookPoster\FacebookPosterChannel;
use NotificationChannels\FacebookPoster\FacebookPosterPost;

/**
 * Class PostPublished
 * @package App\Notifications
 */
class PostPublished extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [FacebookPosterChannel::class];
    }

    /**
     * @param $blog
     */
    public function toFacebookPoster($post)
    {
        $html = new \voku\Html2Text\Html2Text($post->body);
        return with(new FacebookPosterPost($post->title."\n"."\n" .$html->getText()));
    }
}