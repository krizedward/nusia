<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\User;
use App\Models\Course;
use App\Models\CourseCertificate;
use App\Models\CourseLevel;
use App\Models\CoursePackage;
use App\Models\CoursePackageDiscount;
use App\Models\CoursePayment;
use App\Models\CourseRegistration;
use App\Models\CourseType;
use App\Models\CourseTypeValue;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormQuestionChoice;
use App\Models\FormResponse;
use App\Models\FormResponseDetail;
use App\Models\Instructor;
use App\Models\InstructorSchedule;
use App\Models\MaterialPublic;
use App\Models\MaterialSession;
use App\Models\MaterialType;
use App\Models\MaterialTypeValue;
use App\Models\Message;
use App\Models\Metadata;
use App\Models\Notification;
use App\Models\NotificationDuration;
use App\Models\NotificationLabel;
use App\Models\OtherUser;
use App\Models\PlacementTest;
use App\Models\Rating;
use App\Models\Schedule;
use App\Models\Session;
use App\Models\SessionRegistration;
use App\Models\SessionRegistrationForm;
use App\Models\Student;
use App\Models\Task;
use App\Models\TaskSubmission;
use App\Models\UserNotification;

use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function get_relevant_user_ids_for_chat($can_access_all_in_one_role = 0)
    {
        // ambil daftar sender dan recipient pesan yang dikirim oleh user
        // (tidak termasuk ID user yang login akun ini, tetapi merupakan ID lawan bicaranya)
        // return array
        if($can_access_all_in_one_role) {
            // still have bugs
            $user_id_senders = Message
                ::join('users', 'messages.user_id_recipient', 'users.id')
                ->where('messages.user_id_sender', 'NOT LIKE', Auth::user()->id) // ambil ID lawan bicara
                ->where('users.roles', Auth::user()->roles)
                ->pluck('messages.user_id_sender')->toArray();
            $user_id_recipients = Message
                ::join('users', 'messages.user_id_sender', 'users.id')
                ->where('users.roles', Auth::user()->roles)
                ->where('messages.user_id_recipient', 'NOT LIKE', Auth::user()->id) // ambil ID lawan bicara
                ->pluck('messages.user_id_recipient')->toArray();
        } else {
            $user_id_senders = Message
                ::where('user_id_sender', 'NOT LIKE', Auth::user()->id) // ambil ID lawan bicara
                ->where('user_id_recipient', 'LIKE', Auth::user()->id)
                ->pluck('user_id_sender')->toArray();
            $user_id_recipients = Message
                ::where('user_id_sender', 'LIKE', Auth::user()->id)
                ->where('user_id_recipient', 'NOT LIKE', Auth::user()->id) // ambil ID lawan bicara
                ->pluck('user_id_recipient')->toArray();
        }
        return array_values(array_unique(array_merge($user_id_senders, $user_id_recipients)));
    }
}
