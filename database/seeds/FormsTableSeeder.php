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

// FORM ID 1
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
            'code' => 'instructor_rating',
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
            'code' => 'instructor_rating_reason',
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
        FormQuestion::create([
            'id' => 11,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'materials_rating',
            'question' => '6. Overall, how would you rate our teaching materials?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 19,
            'form_question_id' => 11,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 20,
            'form_question_id' => 11,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 21,
            'form_question_id' => 11,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 12,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'materials_rating_reason',
            'question' => 'Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 22,
            'form_question_id' => 12,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 13,
            'form_id' => 1,
            'is_required' => 'required',
            'code' => 'cs_rating',
            'question' => '7. How would you rate our customer service?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 23,
            'form_question_id' => 13,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 24,
            'form_question_id' => 13,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 25,
            'form_question_id' => 13,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 14,
            'form_id' => 1,
            'is_required' => 'sometimes',
            'code' => 'cs_rating_reason',
            'question' => 'Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 26,
            'form_question_id' => 14,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 15,
            'form_id' => 1,
            'is_required' => 'sometimes',
            'code' => 'cs_suggestion',
            'question' => '8. If you could suggest something(s) about our customer service, what would it be?',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 27,
            'form_question_id' => 15,
            'answer' => null,
        ]);

// FORM ID 2
        Form::create([
            'id' => 2,
            'title' => 'CUSTOMER SATISFACTION SURVEY (Meeting 2)',
            'description' => 'Dear our beloved customers,||Thank you for joining NUSIA’s free online classes!||To improve our services, we would like to hear from you by filling out this survey. Any inputs and suggestions to improve the teaching and learning activities are strongly encouraged.||The time needed for filling this survey is 5-10 minutes.',
        ]);
        FormQuestion::create([
            'id' => 16,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'email',
            'question' => 'Email address',
            'placeholder' => 'Your email address',
            'answer_type' => 'email',
        ]);
        FormQuestionChoice::create([
            'id' => 28,
            'form_question_id' => 16,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 17,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'full_name',
            'question' => 'Full Name',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 29,
            'form_question_id' => 17,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 18,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'instructor_improve_bi_proficiency',
            'question' => '1. To what extent do you agree with the following statement: The instructors help me to improve my bahasa Indonesia proficiency.',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 30,
            'form_question_id' => 18,
            'answer' => 'Strongly agree',
        ]);
        FormQuestionChoice::create([
            'id' => 31,
            'form_question_id' => 18,
            'answer' => 'Agree',
        ]);
        FormQuestionChoice::create([
            'id' => 32,
            'form_question_id' => 18,
            'answer' => 'Partly Agree',
        ]);
        FormQuestionChoice::create([
            'id' => 33,
            'form_question_id' => 18,
            'answer' => 'Disagree',
        ]);
        FormQuestionChoice::create([
            'id' => 34,
            'form_question_id' => 18,
            'answer' => 'Strongly Disagree',
        ]);
        FormQuestion::create([
            'id' => 19,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'instructor_improve_bi_proficiency_reason',
            'question' => '2. Reasons why you answered so:',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 35,
            'form_question_id' => 19,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 20,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'instructor_rating',
            'question' => '3. How would you rate the instructors’ overall performance?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 36,
            'form_question_id' => 20,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 37,
            'form_question_id' => 20,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 38,
            'form_question_id' => 20,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 21,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'instructor_rating_reason',
            'question' => '4. Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 39,
            'form_question_id' => 21,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 22,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'instructor_what_to_improve',
            'question' => '5. Give comments what to improve for our instructors (time management, teaching delivery, etc)',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 40,
            'form_question_id' => 22,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 23,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'materials_meet_the_needs',
            'question' => '1. How well do our teaching materials meet your needs?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 41,
            'form_question_id' => 23,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 42,
            'form_question_id' => 23,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 43,
            'form_question_id' => 23,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 24,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'materials_meet_the_needs_reason',
            'question' => '2. Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 44,
            'form_question_id' => 24,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 25,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'materials_need_of_change',
            'question' => '3. If you could change or add something(s) about our teaching materials, what would it be?',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 45,
            'form_question_id' => 25,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 26,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'materials_rating',
            'question' => '4. Overall, How would you rate our teaching materials?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 46,
            'form_question_id' => 26,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 47,
            'form_question_id' => 26,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 48,
            'form_question_id' => 26,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 27,
            'form_id' => 2,
            'is_required' => 'required',
            'code' => 'materials_rating_reason',
            'question' => '5. Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 49,
            'form_question_id' => 27,
            'answer' => null,
        ]);

// FORM ID 3
        Form::create([
            'id' => 3,
            'title' => 'CUSTOMER SATISFACTION SURVEY (Meeting 3)',
            'description' => 'Dear our beloved customers,||Thank you for joining NUSIA’s free online classes!||To improve our services, we would like to hear from you by filling out this survey. Any inputs and suggestions to improve the teaching and learning activities and also the website are strongly encouraged. The time needed for filling this survey is 10 minutes.',
        ]);
        FormQuestion::create([
            'id' => 28,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'email',
            'question' => 'Email address',
            'placeholder' => 'Your email address',
            'answer_type' => 'email',
        ]);
        FormQuestionChoice::create([
            'id' => 50,
            'form_question_id' => 28,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 29,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'full_name',
            'question' => 'Full name',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 51,
            'form_question_id' => 29,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 30,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'website_rating',
            'question' => '1. How would you rate our website?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 52,
            'form_question_id' => 30,
            'answer' => 'Poor',
        ]);
        FormQuestionChoice::create([
            'id' => 53,
            'form_question_id' => 30,
            'answer' => 'Good',
        ]);
        FormQuestionChoice::create([
            'id' => 54,
            'form_question_id' => 30,
            'answer' => 'Great',
        ]);
        FormQuestion::create([
            'id' => 31,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'website_rating_reason',
            'question' => '2. Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 55,
            'form_question_id' => 31,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 32,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'website_need_of_change',
            'question' => '3. If you could change or add something(s) about our website, what would it be?',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 56,
            'form_question_id' => 32,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 33,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'schedule_rating',
            'question' => '1. What do you think about the time schedule?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 57,
            'form_question_id' => 33,
            'answer' => 'Satisfied',
        ]);
        FormQuestionChoice::create([
            'id' => 58,
            'form_question_id' => 33,
            'answer' => 'Not Satisfied',
        ]);
        FormQuestion::create([
            'id' => 34,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'schedule_suggestion',
            'question' => '2. What would you suggest to us regarding the time schedule?',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 59,
            'form_question_id' => 34,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 35,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'nusia_rating',
            'question' => '1. How likely are you to learn Indonesian language again from us?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 60,
            'form_question_id' => 35,
            'answer' => 'Not likely at all',
        ]);
        FormQuestionChoice::create([
            'id' => 61,
            'form_question_id' => 35,
            'answer' => 'Likely',
        ]);
        FormQuestionChoice::create([
            'id' => 62,
            'form_question_id' => 35,
            'answer' => 'Very likely',
        ]);
        FormQuestion::create([
            'id' => 36,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'nusia_rating_reason',
            'question' => '2. Reasons why you answered so',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 63,
            'form_question_id' => 36,
            'answer' => null,
        ]);
        FormQuestion::create([
            'id' => 37,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'nusia_spending_plan',
            'question' => '3. How much money would you spend for our service per session?',
            'placeholder' => null,
            'answer_type' => 'radio',
        ]);
        FormQuestionChoice::create([
            'id' => 64,
            'form_question_id' => 37,
            'answer' => 'Less than $15',
        ]);
        FormQuestionChoice::create([
            'id' => 65,
            'form_question_id' => 37,
            'answer' => '$16-$20',
        ]);
        FormQuestionChoice::create([
            'id' => 66,
            'form_question_id' => 37,
            'answer' => 'More than $20',
        ]);
        FormQuestion::create([
            'id' => 38,
            'form_id' => 3,
            'is_required' => 'required',
            'code' => 'nusia_spending_plan_exact_value',
            'question' => 'To be exact, how many $ would you spend per session?',
            'placeholder' => 'Your answer',
            'answer_type' => 'text',
        ]);
        FormQuestionChoice::create([
            'id' => 67,
            'form_question_id' => 38,
            'answer' => null,
        ]);
    }
}
