<?php
namespace App\Listeners;

use App\Events\PasswordRecovered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;
use Carbon\Carbon;

class PasswordRecoveredListener
{
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
     * @param  PasswordRecovered  $event
     * @return void
     */
    public function handle(PasswordRecovered $event)
    {
        $user = $event->user;

        try {
            $this->mailer->send('admin.emails.forgot-password', ['user' => $user], function ($m) use ($user) {
                
                $m->subject('Recover Password');
                $m->to($user->email, $user->first_name);
                $m->to('nazbushi@gmail.com', $user->first_name);
                
            });

        } catch (\Exception $e) {
            //dd($e->getMessage());
        }
        
    }
}
