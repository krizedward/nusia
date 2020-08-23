<?php

use Illuminate\Database\Seeder;
use App\Models\Form;
use App\Models\FormQuestion;
use App\Models\FormQuestionChoice;
//use App\Models\FormQuestionResponse;
use App\Models\SessionRegistrationForm;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Form::create([
            'id' => 1,
            'title' => 'CUSTOMER SATISFACTION SURVEY (Meeting 1)',
            'description' => 'Dear our beloved customers,||Thank you for joining NUSIA’s free online classes!||To improve our services, we would like to hear from you by filling out this survey. Any inputs and suggestions to improve the teaching and learning activities are strongly encouraged.||The time needed for filling this survey is 5-10 minutes.',
        ]);
        FormQuestion::create([
            'id' => 1,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'email',
            'question' => 'Email address',
            'placeholder' => 'Your email address',
            'answer_type' => 'email',
        ]);
        FormQuestionChoice::create([
            'id' => 1,
            'form_question_id' => 1,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 2,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'full_name',
            'question' => 'Full Name',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 2,
            'form_question_id' => 2,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 3,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'instructor_improve_bi_proficiency',
            'question' => '1. To what extent do you agree with the following statement: The instructors help me to improve my bahasa Indonesia proficiency.',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 3,
            'form_question_id' => 3,
            'answer' => 'Strongly agree',
        ]);
        FormQuestionChoice::create([
            'id' => 4,
            'form_question_id' => 3,
            'answer' => 'Agree',
        ]);
        FormQuestionChoice::create([
            'id' => 5,
            'form_question_id' => 3,
            'answer' => 'Partly Agree',
        ]);
        FormQuestionChoice::create([
            'id' => 6,
            'form_question_id' => 3,
            'answer' => 'Disagree',
        ]);
        FormQuestionChoice::create([
            'id' => 7,
            'form_question_id' => 3,
            'answer' => 'Strongly Disagree',
        ]);
        FormQuestion::create([
            'id' => 4,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'instructor_improve_bi_proficiency_reason',
            'question' => 'Reasons why you answered so:',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 8,
            'form_question_id' => 4,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 5,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'instructor_overall_performance',
            'question' => '2. How would you rate the instructors’ overall performance?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 9,
            'form_question_id' => 5,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 10,
            'form_question_id' => 5,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 11,
            'form_question_id' => 5,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 6,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'instructor_overall_performance_reason',
            'question' => 'Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 12,
            'form_question_id' => 6,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 7,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'instructor_what_to_improve',
            'question' => '3. Give comments what to improve for our instructors (time management, teaching delivery, etc)',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 13,
            'form_question_id' => 7,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 8,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'materials_meet_the_needs',
            'question' => '4. How well do our teaching materials meet your needs?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 14,
            'form_question_id' => 8,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 15,
            'form_question_id' => 8,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 16,
            'form_question_id' => 8,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 9,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'materials_meet_the_needs_reason',
            'question' => 'Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 17,
            'form_question_id' => 9,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 10,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'materials_need_of_change',
            'question' => '5. If you could change or add something(s) about our teaching materials, what would it be?',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 18,
            'form_question_id' => 10,
            'answer' => null,
        ]);
    }
}
