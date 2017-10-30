<?php

namespace App\Listeners;

use App\Events\SendNotificationEvent;
use App\Events\UserRegisteredEvent;
use App\Models\Widget;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendNotificationListener
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SendNotificationEvent $event
     */
    public function handle(SendNotificationEvent $event)
    {
	    Mail::queue('emails.sendNotification', ['notification' => $event->message], function ($msg) use ($event) {
		    $msg->to(explode(',', $event->message['recipientEmail']));
		    if(array_get($event->message, 'bccEmail'))
		        $msg->bcc(explode(',', $event->message['bccEmail']));
		    
//		    if($event->message['type'] == 'newTrener') {
//		        $msg->subject('Добавлен новый специалист!');
//		    }
	    });
    }
}
