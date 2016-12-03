<?php
namespace App\Listeners;

use App\Events\Activation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;

class ActivationListener {
    public $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  Activation  $event
     * @return void
     */
    public function handle(Activation $event)
    {
        $user = $event->user;
        $user->first_name = $user->first_name;

        try {
            $this->mailer->send('emails.activation', ['user' => $user], function ($m) use ($user) {
            
                $m->subject('Account Activation');
                $m->to($user->email, $user->first_name);
                $m->to('nazbushi@gmail.com', $user->first_name);
        
            });
        } catch (\Exception $e) {
            //dd($e->getMessage());
        }
        
    }
}
