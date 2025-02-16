<!-- Queues & Background Jobs
A user submits a form that triggers an email notification. How would you ensure the email is sent asynchronously in Laravel?

===========================Answer=============================== -->

<?php

namespace App\Jobs;

use Mail;
use App\Mail\NotifyUser;  // our Mailable class
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle()
    {
        Mail::to($this->user->email)->send(new NotifyUser($this->user));
    }
}
?>

<!-- In our controller, you can dispatch the job like this: -->
<?php
use App\Jobs\SendEmailJob;

public function submitForm(Request $request)
{
    $user = User::find($request->user_id);
    dispatch(new SendEmailJob($user));

    return response()->json(['msg' => 'Your email is now in word wide web!']);
}


?>