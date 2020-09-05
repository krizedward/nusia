<?php

namespace App\Http\Controllers;

use App\Models\FormResponse;
use Illuminate\Http\Request;

use App\User;
use App\Models\SessionRegistration;
use App\Models\SessionRegistrationForm;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormQuestionChoice;
use App\Models\FormResponseDetail;

use Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class FormResponseController extends Controller
{
    /**
     * Memeriksa role User saat ini.
     * Return user.roles atau null.
     */
    public function user_roles() {
        return (Auth::check())? Auth::user()->roles : null;
    }

    /**
     * Memeriksa jenis role User saat ini.
     * 1: True (jenis role sesuai)
     * 0: False (jenis role tidak sesuai)
     */
    public function is_admin() {
        return ($this->user_roles() == "Admin")? 1 : 0;
    }
    public function is_instructor() {
        return ($this->user_roles() == "Instructor")? 1 : 0;
    }
    public function is_student() {
        return ($this->user_roles() == "Student")? 1 : 0;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($this->is_admin()) {
            $forms = Form::all();

            // WIDGET 1: Number of Feedback(s) Received
            $session_registration_forms = SessionRegistrationForm
                ::select('session_registration_forms.session_registration_id as id')
                ->get();

            $arr = [];
            $widget_1 = 0;
            foreach($session_registration_forms as $srf) if(!in_array($srf->id, $arr)) {
                array_push($arr, $srf->id);
                $widget_1++;
            }

            // WIDGET 2
            $form_widget_2 = FormResponse
                ::where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 5)
                        ->orWhere('form_responses.form_question_id', 20);
                })
                ->get();
            $widget_2 = 0;
            foreach($form_widget_2 as $fw) {
                if(
                    $fw->form_response_details->first()->answer == 'Great'
                    || $fw->form_response_details->first()->answer == 'Good'
                    || $fw->form_response_details->first()->answer == 'Strongly Agree'
                    || $fw->form_response_details->first()->answer == 'Agree'
                ) $widget_2++;
            }

            // WIDGET 3
            $form_widget_3 = FormResponse
                ::where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 5)
                        ->orWhere('form_responses.form_question_id', 20);
                })
                ->get();
            $widget_3 = 0;
            foreach($form_widget_3 as $fw) {
                if(
                    $fw->form_response_details->first()->answer == 'Poor'
                    || $fw->form_response_details->first()->answer == 'Partly Agree'
                    || $fw->form_response_details->first()->answer == 'Disagree'
                    || $fw->form_response_details->first()->answer == 'Strongly Disagree'
                ) $widget_3++;
            }

            $rating = FormResponse::all()->count();

            return view('form_responses.admin_index',compact(
                'forms', 'widget_1', 'widget_2', 'widget_3', 'rating'
            ));
        } else if($this->is_instructor()) {
            $forms = Form::where('is_accessible_by', 2)->get();

            // WIDGET 1: Number of Feedback(s) Received
            $session_registration_forms = SessionRegistrationForm
                ::join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->select('session_registration_forms.session_registration_id as id')
                ->get();

            $arr = [];
            $widget_1 = 0;
            foreach($session_registration_forms as $srf) if(!in_array($srf->id, $arr)) {
                array_push($arr, $srf->id);
                $widget_1++;
            }

            // WIDGET 2
            $form_widget_2 = FormResponse
                ::join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 5)
                        ->orWhere('form_responses.form_question_id', 20);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();
            $widget_2 = 0;
            foreach($form_widget_2 as $fw) {
                if(
                    $fw->form_response_details->first()->answer == 'Great'
                    || $fw->form_response_details->first()->answer == 'Good'
                    || $fw->form_response_details->first()->answer == 'Strongly Agree'
                    || $fw->form_response_details->first()->answer == 'Agree'
                ) $widget_2++;
            }

            // WIDGET 3
            $form_widget_3 = FormResponse
                ::join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 5)
                        ->orWhere('form_responses.form_question_id', 20);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();
            $widget_3 = 0;
            foreach($form_widget_3 as $fw) {
                if(
                    $fw->form_response_details->first()->answer == 'Poor'
                    || $fw->form_response_details->first()->answer == 'Partly Agree'
                    || $fw->form_response_details->first()->answer == 'Disagree'
                    || $fw->form_response_details->first()->answer == 'Strongly Disagree'
                ) $widget_3++;
            }

            $rating = FormResponse::all()->count();

            return view('form_responses.instructor_index',compact(
                'forms', 'widget_1', 'widget_2', 'widget_3', 'rating'
            ));
        } else {
            return redirect()->route('home');
        }
    }

    public function index_form($form_id)
    {
        if($this->is_admin()) {
            $form = Form::findOrFail($form_id);

            $form_responses = FormResponse::all();

            $session_registrations = SessionRegistration
                ::join('session_registration_forms', 'session_registrations.id', 'session_registration_forms.session_registration_id')
                ->join('form_responses', 'session_registration_forms.form_response_id', 'form_responses.id')
                ->join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->distinct()
                ->where('session_registrations.status', 'Present')
                ->select('session_registrations.id', 'session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at')
                ->get();

            // ANSWER TYPE: RADIO BOX
            $form_widget_1 = FormResponse
                ::join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 3)
                        ->orWhere('form_responses.form_question_id', 18);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            // ANSWER TYPE: RADIO BOX
            $form_widget_2 = FormResponse
                ::join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 5)
                        ->orWhere('form_responses.form_question_id', 20);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            // ANSWER TYPE: TEXT
            $form_widget_3 = FormResponse
                ::join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 7)
                        ->orWhere('form_responses.form_question_id', 22);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            return view('form_responses.admin_index_form',compact(
                'form', 'form_responses', 'session_registrations', 'form_widget_1', 'form_widget_2', 'form_widget_3'
            ));
        } else if($this->is_instructor()) {
            $form = Form::findOrFail($form_id);

            $form_responses = FormResponse
                ::join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            $session_registrations = SessionRegistration
                ::join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('session_registration_forms', 'session_registrations.id', 'session_registration_forms.session_registration_id')
                ->join('form_responses', 'session_registration_forms.form_response_id', 'form_responses.id')
                ->join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->distinct()
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where('session_registrations.status', 'Present')
                ->select('session_registrations.id', 'session_registrations.code', 'session_registrations.session_id', 'session_registrations.course_registration_id', 'session_registrations.registration_time', 'session_registrations.status', 'session_registrations.created_at', 'session_registrations.updated_at')
                ->get();

            // ANSWER TYPE: RADIO BOX
            $form_widget_1 = FormResponse
                ::join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 3)
                        ->orWhere('form_responses.form_question_id', 18);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            // ANSWER TYPE: RADIO BOX
            $form_widget_2 = FormResponse
                ::join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 5)
                        ->orWhere('form_responses.form_question_id', 20);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            // ANSWER TYPE: TEXT
            $form_widget_3 = FormResponse
                ::join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->join('sessions', 'session_registrations.session_id', 'sessions.id')
                ->join('schedules', 'sessions.schedule_id', 'schedules.id')
                ->join('form_questions', 'form_responses.form_question_id', 'form_questions.id')
                ->join('forms', 'form_questions.form_id', 'forms.id')
                ->where('forms.id', $form_id)
                ->where(function($q) {
                    $q
                        ->where('schedules.instructor_id', Auth::user()->instructor->id)
                        ->orWhere('schedules.instructor_id_2', Auth::user()->instructor->id);
                })
                ->where(function($q) {
                    $q
                        ->where('form_responses.form_question_id', 7)
                        ->orWhere('form_responses.form_question_id', 22);
                })
                ->select('form_responses.id', 'form_responses.form_question_id', 'form_responses.created_at', 'form_responses.updated_at')
                ->get();

            return view('form_responses.instructor_index_form',compact(
                'form', 'form_responses', 'session_registrations', 'form_widget_1', 'form_widget_2', 'form_widget_3'
            ));
        } else {
            return redirect()->route('home');
        }
    }

    public function index_session($session_id)
    {
        if($this->is_admin()) {
            $forms = Form
                ::join('form_questions', 'forms.id', 'form_questions.form_id')
                ->join('form_responses', 'form_questions.id', 'form_responses.form_question_id')
                ->join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->where('session_registrations.session_id', $session_id)
                ->select('forms.id', 'forms.title', 'forms.description', 'forms.is_accessible_by', 'forms.created_at', 'forms.updated_at')
                ->get();

            return view('form_responses.admin_index',compact(
                'forms'
            ));
        } else if($this->is_instructor()) {
            $forms = Form
                ::join('form_questions', 'forms.id', 'form_questions.form_id')
                ->join('form_responses', 'form_questions.id', 'form_responses.form_question_id')
                ->join('session_registration_forms', 'form_responses.id', 'session_registration_forms.form_response_id')
                ->join('session_registrations', 'session_registration_forms.session_registration_id', 'session_registrations.id')
                ->where('session_registrations.session_id', $session_id)
                ->where('forms.is_accessible_by', 2)
                ->select('forms.id', 'forms.title', 'forms.description', 'forms.is_accessible_by', 'forms.created_at', 'forms.updated_at')
                ->get();

            return view('form_responses.instructor_index',compact(
                'forms'
            ));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($session_registration_id)
    {
        if($this->is_student()) {
            $session_registration = SessionRegistration::where('id', $session_registration_id)->first();
            if($session_registration->course_registration->student_id != Auth::user()->student->id) {
                // Student tidak diperbolehkan mengakses formulir yang tidak relevan dengan sesi yang bersangkutan.
                return redirect()->route('session_registrations.index');
            } else if(now() <= Carbon::parse($session_registration->session->schedule->schedule_time)->add(80, 'minutes')) {
                // Student tidak diperbolehkan mengakses formulir sebelum waktunya.
                return redirect()->route('session_registrations.index');
            } else if($session_registration->status != 'Should Submit Form') {
                // Student tidak diperbolehkan mengakses formulir sebelum dinyatakan hadir oleh Instructor.
                return redirect()->route('session_registrations.index');
            }

            $form = $session_registration->session->form;

            return view('form_responses.student_create',compact(
                'form', 'session_registration_id'
            ));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $session_registration_id)
    {
        $session_registration = SessionRegistration::where('id', $session_registration_id)->first();
        if($session_registration->course_registration->student_id != Auth::user()->student->id) {
            // Student tidak diperbolehkan mengakses formulir yang tidak relevan dengan sesi yang bersangkutan.
            return redirect()->route('session_registrations.index');
        } else if(now() <= Carbon::parse($session_registration->session->schedule->schedule_time)->add(80, 'minutes')) {
            // Student tidak diperbolehkan mengakses formulir sebelum waktunya.
            return redirect()->route('session_registrations.index');
        } else if($session_registration->status != 'Should Submit Form') {
            // Student tidak diperbolehkan mengakses formulir sebelum dinyatakan hadir oleh Instructor.
            return redirect()->route('session_registrations.index');
        }

        $form = $session_registration->session->form;

        // FORM VALIDATION
        foreach($form->form_questions as $fq) {
            if($fq->answer_type == 'checkbox') {
                foreach($request->all() as $key => $val) {
                    $flag = 0;
                    foreach($fq->form_question_choices as $fqc) {
                        if($key == 'checkbox' . $fq->id . 'on' . $fqc->id) {
                            $flag = 1;
                            break;
                        }
                    }
                    // NOT YET FINISHED FOR THIS CHECKBOX VALIDATION.
                }
            } else if($fq->answer_type == 'radio') {
                $flag = 0;
                foreach($request->all() as $key => $val) {
                    if($key == $fq->code) {
                        $flag = 1;
                        break;
                    }
                }
                if($flag == 0) {
                    session([$fq->code => 'This radio button field is required.']);
                    return redirect()->back()->withInput();
                }
            } else if($fq->answer_type == 'text' || $fq->answer_type == 'email') {
                foreach($request->all() as $key => $val) {
                    if($key == $fq->code) {
                        $data = Validator::make($request->all(), [
                            $fq->code => $fq->is_required,
                        ]);
                        if($data->fails()) {
                            return redirect()->back()
                                ->withErrors($data)
                                ->withInput();
                        }
                        break;
                    }
                }
            }
        }

        if($this->is_student()) {
            foreach($form->form_questions as $fq) {
                FormResponse::create([
                    'form_question_id' => $fq->id,
                ]);
                foreach($request->all() as $key => $val) {
                    if($key == $fq->code) {
                        FormResponseDetail::create([
                            'form_response_id' => FormResponse::all()->last()->id,
                            'answer' => $val,
                        ]);
                        break;
                    }
                }
                SessionRegistrationForm::create([
                    'session_registration_id' => $session_registration_id,
                    'form_response_id' => FormResponse::all()->last()->id,
                ]);
            }
            $session_registration = SessionRegistration::findOrFail($session_registration_id);
            $session_registration->update([
                'status' => 'Present',
            ]);
            session(['form_complete' => 'Thank you for your participation in completing the feedback form.']);
        } else {
            // Tidak memiliki izin akses.
        }
        return redirect()->route('session_registrations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($session_registration_id)
    {
        if($this->is_admin()) {
            $session_registration = SessionRegistration::where('id', $session_registration_id)->first();

            return view('form_responses.admin_show',compact(
                'session_registration'
            ));
        } else if($this->is_instructor()) {
            $session_registration = SessionRegistration::where('id', $session_registration_id)->first();
            /*
            if($session_registration->session_registration_forms->form_response->form_question->form->is_accessible_by == 1) {
                // Tidak memiliki izin akses.
                return redirect()->route('home');
            }
            */

            return view('form_responses.instructor_show',compact(
                'session_registration'
            ));
        } else {
            return redirect()->route('home');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $file = $request->file('image_profile');

        $data = $request->all();
        $data = Validator::make($data, [
            'timezone' => ['bail', 'sometimes'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],
        ]);

        // FOR TIMEZONE
        $timezones = [
            '-11', '-10', '-09:30', '-09', '-08', '-07',
            '-06', '-05', '-04', '-03', '-02', '-01',
            '+00', '+01', '+02', '+03', '+04', '+04:30', '+05', '+05:30', '+05:45', '+06',
            '+06:30', '+07', '+08', '+08:45', '+09', '+09:30', '+10', '+11', '+12', '+13', '+14',
        ];

        $zone_names = [
            'Pacific/Pago_Pago',      // -11
            'Pacific/Rarotonga',      // -10
            'Pacific/Marquesas',      // -09:30
            'Pacific/Gambier',        // -09
            'Pacific/Pitcairn',       // -08
            'America/Phoenix',        // -07
            'America/Costa_Rica',     // -06
            'America/Panama',         // -05
            'America/Port_of_Spain',  // -04
            'America/Montevideo',     // -03
            'Atlantic/South_Georgia', // -02
            'Atlantic/Cape_Verde',    // -01
            'Africa/Abidjan',         // +00
            'Africa/Lagos',           // +01
            'Africa/Maputo',          // +02
            'Africa/Nairobi',         // +03
            'Asia/Dubai',             // +04
            'Asia/Kabul',             // +04:30
            'Asia/Ashgabat',          // +05
            'Asia/Colombo',           // +05:30
            'Asia/Kathmandu',         // +05:45
            'Asia/Dhaka',             // +06
            'Asia/Yangon',            // +06:30
            'Asia/Bangkok',           // +07
            'Asia/Macau',             // +08
            'Australia/Eucla',        // +08:45
            'Asia/Tokyo',             // +09
            'Australia/Darwin',       // +09:30
            'Asia/Vladivostok',       // +10
            'Pacific/Pohnpei',        // +11
            'Pacific/Nauru',          // +12
            'Pacific/Fakaofo',        // +13
            'Pacific/Kiritimati',     // +14
        ];

        for($i = 0; $i < count($timezones); $i++) {
            if($request->timezone == $timezones[$i]) {
                $request->timezone = $zone_names[$i];
                break;
            }
        }

        if ($this->is_student()){

            if(Auth::user()->image_profile != 'user.jpg') {
                $destinationPath = 'uploads/student/profile/';
                File::delete($destinationPath . Auth::user()->image_profile);
            }

            if($file) {
                $file_name = Str::random(50).'.'.$file->extension();

                $student->user->update([
                    'image_profile' => $file_name,
                ]);

                //Move Uploaded File
                $destinationPath = 'uploads/student/profile/';
                $file->move($destinationPath, $file_name);
            }

            $student->user->update([
                'timezone' => $request->timezone,
            ]);

            return redirect()->route('profile', $student->user->id);
        }

        if($this->is_admin()) {

        $interest = array(
            $request->interest_1,
            $request->interest_2,
            $request->interest_3,
            $request->interest_4,
            $request->interest_5,
            $request->interest_6
        );
        for($i = 0; $i < 6; $i = $i + 1) {
            if($interest[$i] == null) unset($interest[$i]);
        }

        $interest = implode(', ', $interest);

        if($interest != null) {
            $request->interest_1 = 'PASS';
        } else $request->interest_1 = null;

        $data = $request->all();
        $data = Validator::make($data, [
            'first_name' => ['bail', 'required'],
            'last_name' => ['bail', 'required'],
            'email' => ['bail', 'required', Rule::unique('users')->ignore($student->user->id, 'id')],
            'password' => ['bail', 'required', 'min:8'],
            'phone' => ['bail', 'sometimes'],
            'citizenship' => ['bail', 'required'],
            'image_profile' => ['bail', 'sometimes', 'max:8000'],

            'age' => ['bail', 'required', 'integer'],
            'status_job' => ['bail', 'required'],
            'status_description' => ['bail', 'required'],
            'interest_1' => ['bail', 'required'],
            'target_language_experience' => ['bail', 'required'],
            'target_language_experience_value' => ['bail', 'required_if:target_language_experience,Others'],
            'description_of_course_taken' => ['bail', 'required_unless:target_language_experience,Never (no experience)'],
            'indonesian_language_proficiency' => ['bail', 'required'],
            'learning_objective' => ['bail', 'required'],
        ]);

        if($data->fails()) {
            return redirect()->back()
                ->withErrors($data)
                ->withInput();
        }

        if($file) {
            $file_name = Str::random(50).'.'.$file->extension();
        }

            $student->user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'citizenship' => $request->citizenship,
                'image_profile' => ($file)? $file_name : 'user.jpg',
            ]);

            $student->update([
                'age' => $request->age,
                'status_job' => $request->status_job,
                'status_description' => $request->status_description,
                'interest' => $interest,
                'target_language_experience' => $request->target_language_experience,
                'target_language_experience_value' => $request->target_language_experience_value,
                'description_of_course_taken' => $request->description_of_course_taken,
                'indonesian_language_proficiency' => $request->indonesian_language_proficiency,
                'learning_objective' => $request->learning_objective,
            ]);

            \Session::flash('coba','Update Success !!!');
        } else {
            // Tidak memiliki izin akses.
        }

        return redirect()->route('students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = MaterialSession::findOrFail($id);

        if($this->is_admin() || $this->is_instructor()) {
            if($data->path != null) {
                $destinationPath = 'uploads/material/';
                File::delete($destinationPath . $data->path);
            }
            $data->delete();
        } else {
            // Tidak memiliki hak akses.
        }

        return redirect()->route('materials.index');
    }
}
