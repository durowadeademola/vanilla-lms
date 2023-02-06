<?php

namespace App\Listeners;

use App\Events\StudentUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class StudentUpdatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  StudentUpdated  $event
     * @return void
     */
    public function handle(StudentUpdated $event)
    {
        //Update user Record
        $user = User::where('student_id', $event->student->id)->first();
        $user->email = $event->student->email;
        $user->telephone = $event->student->telephone;
        $user->student_id = $event->student->id;
        $user->lecturer_id = null;
        $user->department_id = $event->student->department_id;
        $user->name = "{$event->student->first_name} {$event->student->last_name}";
        $user->sex = $event->student->sex;
        $user->is_platform_admin = false;
        $user->save();
    }
}
