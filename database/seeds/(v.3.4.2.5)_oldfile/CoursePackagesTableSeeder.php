<?php

use Illuminate\Database\Seeder;
use App\Models\CoursePackage;

class oldCoursePackagesTableSeeder extends Seeder
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
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Fixed Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Fixed Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Fixed Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Fixed Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Fixed Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Fixed Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Fixed Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Fixed Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Fixed Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Fixed Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Fixed Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Fixed Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Fixed Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Fixed Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Fixed Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Fixed Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Fixed Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Fixed Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 2,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Fixed Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Customized Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Customized Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Customized Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Customized Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Customized Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Customized Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Customized Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Customized Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Customized Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 30,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Customized Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Customized Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Customized Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Customized Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Customized Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Customized Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Customized Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Customized Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Customized Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Customized Materials for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Customized Materials for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Customized Materials for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Customized Materials for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Customized Materials for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Customized Materials for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Customized Materials for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Customized Materials for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 3,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Customized Materials for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Basic Conversation for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Basic Conversation for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Basic Conversation for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Basic Conversation for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Basic Conversation for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Basic Conversation for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Private Course with Basic Conversation for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Private Course with Basic Conversation for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 2,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Private Course with Basic Conversation for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 25,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Basic Conversation for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Basic Conversation for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 4,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Basic Conversation for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Basic Conversation for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Basic Conversation for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 5,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Basic Conversation for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Group Course with Basic Conversation for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Group Course with Basic Conversation for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 6,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Group Course with Basic Conversation for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 15,
            'price'                  => 20,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Novice-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Novice-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 2,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Novice-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Intermediate-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Intermediate-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 3,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Intermediate-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 2,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Advanced-Low Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 3,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Advanced-Mid Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
        CoursePackage::create ([
            'slug'                   => Str::random(255),
            'material_type_id'       => 4,
            'course_type_id'         => 7,
            'course_level_id'        => 4,
            'course_level_detail_id' => 4,
            'title'                  => 'Trial (Group) Course with Basic Conversation for Advanced-High Difficulty',
            'description'            => 'This states a course package description.',
            'requirement'            => 'This states a course package requirement.',
            'count_session'          => 3,
            'price'                  => 0,
            'created_at'             => now(),
            'updated_at'             => null
        ]);
    }
}
