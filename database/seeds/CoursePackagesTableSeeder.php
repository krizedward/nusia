<?php

use Illuminate\Database\Seeder;
use App\Models\CoursePackage;

class CoursePackagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\Models\CoursePackage::class, 20)
            ->states('Randomized')
            ->create()
            ->make();*/

        CoursePackage::create ([
            'code'                   => 'CP-001',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Free Classes for Novice Proficiency',
            'description'            => null,
            'requirement'            => null,
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-002',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Free Classes for Intermediate Proficiency',
            'description'            => null,
            'requirement'            => null,
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-003',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Free Classes for Advanced Proficiency',
            'description'            => null,
            'requirement'            => null,
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);

        /*CoursePackage::create ([
            'code'                   => 'CP-001',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => null,
            'description'            => null,
            'requirement'            => null,
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:10',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-002',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Fixed Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-003',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Fixed Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-004',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Fixed Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-005',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Fixed Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-006',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Fixed Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-007',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Fixed Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-008',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Fixed Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-009',
            'material_type_id'       => 1,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Fixed Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-010',
            'material_type_id'       => 1,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Fixed Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-011',
            'material_type_id'       => 1,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Fixed Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-012',
            'material_type_id'       => 1,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Fixed Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-013',
            'material_type_id'       => 1,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Fixed Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-014',
            'material_type_id'       => 1,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Fixed Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-015',
            'material_type_id'       => 1,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Fixed Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-016',
            'material_type_id'       => 1,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Fixed Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-017',
            'material_type_id'       => 1,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Fixed Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-017',
            'material_type_id'       => 1,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Fixed Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-018',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-019',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-020',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-021',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-022',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-023',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-024',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-025',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-026',
            'material_type_id'       => 1,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-027',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Customized Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-028',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Customized Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-029',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Customized Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-030',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Customized Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-031',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Customized Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-032',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Customized Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-033',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Customized Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-034',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Customized Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-035',
            'material_type_id'       => 2,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Customized Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-036',
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Customized Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-037',
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Customized Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-038',
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Customized Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-039',
            'material_type_id'       => 2,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Customized Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-040',
            'material_type_id'       => 2,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Customized Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-041',
            'material_type_id'       => 2,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Customized Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-042',
            'material_type_id'       => 2,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Customized Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-043',
            'material_type_id'       => 2,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Customized Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-044',
            'material_type_id'       => 2,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Customized Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-045',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Customized Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-046',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Customized Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-047',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Customized Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-048',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Customized Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-049',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Customized Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-050',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Customized Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-051',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Customized Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-052',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Customized Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-053',
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Customized Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-054',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Basic Conversation for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-055',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Basic Conversation for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-056',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Basic Conversation for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-057',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Basic Conversation for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-058',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Basic Conversation for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-059',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Basic Conversation for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-060',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Private Course with Basic Conversation for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-061',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Basic Conversation for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-062',
            'material_type_id'       => 3,
            'course_type_id'         => 1,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Basic Conversation for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-063',
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Basic Conversation for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-064',
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Basic Conversation for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-065',
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Basic Conversation for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-066',
            'material_type_id'       => 3,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Basic Conversation for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-067',
            'material_type_id'       => 3,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Basic Conversation for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-068',
            'material_type_id'       => 3,
            'course_type_id'         => 3,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Basic Conversation for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-069',
            'material_type_id'       => 3,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Group Course with Basic Conversation for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-070',
            'material_type_id'       => 3,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Basic Conversation for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-071',
            'material_type_id'       => 3,
            'course_type_id'         => 4,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Basic Conversation for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-072',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-073',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-074',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 1,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-075',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-076',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-077',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-078',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 1,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-079',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'code'                   => 'CP-080',
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => '2020-08-07 05:12:11',
            'updated_at'             => null
        ]);*/
    }
}
