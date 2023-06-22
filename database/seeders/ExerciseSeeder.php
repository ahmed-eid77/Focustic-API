<?php

namespace Database\Seeders;

use App\Models\Exercise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ExerciseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Exercise::create([
            'name'        => 'QL Stretch with Reach',
            'description' => 'Demonstration of how to perform QL Stretch with Reach.',
            'body_part'   => 'arm',
            'repetitions' => 4,
            'sets'        => 12,
            'duration'    => 30,
            'cover'       => 'assets/exercises/covers/1',
            'link'        => 'https://youtu.be/JEwwd244N9E',
            'category_id' => 1
        ]);

        Exercise::create([
            'name'        => 'Slant Board Calf Raise',
            'description' => 'Demonstration of how to perform Slant Board Calf Raise.',
            'body_part'   => 'Calf',
            'repetitions' => 6,
            'sets'        => 12,
            'duration'    => 15,
            'cover'       => 'assets/exercises/covers/2',
            'link'        => 'https://youtu.be/dZPSE7pr5qY',
            'category_id' => 1
        ]);

        Exercise::create([
            'name'        => 'Seated Knee Extension',
            'description' => 'Demonstration of how to perform Seated Knee Extension.',
            'body_part'   => 'leg',
            'repetitions' => 6,
            'sets'        => 6,
            'duration'    => 10,
            'cover'       => 'assets/exercises/covers/3',
            'link'        => 'https://youtu.be/H0ejJlqpmK0',
            'category_id' => 1
        ]);

        Exercise::create([
            'name'        => 'A Skips - dynamic warmup for runners',
            'description' => 'Demonstration of how to perform A Skips - dynamic warmup for runners',
            'body_part'   => 'leg',
            'repetitions' => 7,
            'sets'        => 12,
            'duration'    => 10,
            'cover'       => 'assets/exercises/covers/4',
            'link'        => 'https://youtu.be/2tAo44A1fwE',
            'category_id' => 1
        ]);
        //====================================================================================================
        Exercise::create([
            'name'        => 'Stiff Neck Relief',
            'description' => 'Demonstration of how to perform stiff Neck Relief',
            'body_part'   => 'neck',
            'repetitions' => 6,
            'sets'        => 12,
            'duration'    => 10,
            'cover'       => 'assets/exercises/covers/5',
            'link'        => 'https://www.youtube.com/shorts/Z8H_SAoyGlI',
            'category_id' => 2
        ]);
        //====================================================================================================
        Exercise::create([
            'name'        => 'Breathing and Relaxation',
            'description' => 'description',
            'body_part'   => 'Eye',
            'repetitions' => 6,
            'sets'        => 12,
            'duration'    => 10,
            'cover'       => 'assets/exercises/covers/6',
            'link'        => 'https://www.youtube.com/shorts/QgEpGrcGOAQ',
            'category_id' => 3
        ]);

        Exercise::create([
            'name'        => 'How to Improve Eyesight With Best Exercise',
            'description' => 'description',
            'body_part'   => 'Eye',
            'repetitions' => 6,
            'sets'        => 12,
            'duration'    => 10,
            'cover'       => 'assets/exercises/covers/7',
            'link'        => 'https://youtu.be/xa9Qci04mPA',
            'category_id' => 3
        ]);
        //====================================================================================================
        Exercise::create([
            'name'        => 'Thoracic Spine Extension Strengthening',
            'description' => 'description',
            'body_part'   => 'Back',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/8',
            'link'        => 'https://youtu.be/5m8Ue-aQuok',
            'category_id' => 4
        ]);
        Exercise::create([
            'name'        => 'Better Posture & Less Upper Back Pain!',
            'description' => 'description',
            'body_part'   => 'Back',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/9',
            'link'        => 'https://youtube.com/shorts/NUUJhWcMPX4?feature=share',
            'category_id' => 4
        ]);
        Exercise::create([
            'name'        => 'Spine Stability Exercises',
            'description' => 'description',
            'body_part'   => 'Back',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/10',
            'link'        => 'https://youtube.com/shorts/3KuqoOQs1Pg?feature=share',
            'category_id' => 4
        ]);
        //====================================================================================================
        Exercise::create([
            'name'        => 'take a deep breath',
            'description' => 'description',
            'body_part'   => 'Breathing and Relaxation',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/11',
            'link'        => 'https://youtu.be/92xTPH7OtLs',
            'category_id' => 5
        ]);
        Exercise::create([
            'name'        => 'Mindful Breathing Exercise',
            'description' => 'description',
            'body_part'   => 'Breathing and Relaxation',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/12',
            'link'        => 'https://youtu.be/wfDTp2GogaQ',
            'category_id' => 5
        ]);
        Exercise::create([
            'name'        => '2 min Breathe Bubble',
            'description' => 'description',
            'body_part'   => 'Breathing and Relaxation',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/13',
            'link'        => 'https://youtu.be/9tOJZQhO_Uw',
            'category_id' => 5
        ]);
        //====================================================================================================
        Exercise::create([
            'name'        => '5 Stretches At Your Desk',
            'description' => 'description',
            'body_part'   => 'Stretch Breaks and Micro Movements',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/14',
            'link'        => 'https://youtu.be/9tOJZQhO_Uw',
            'category_id' => 6
        ]);
        Exercise::create([
            'name'        => 'Stretches for People Who Sit All Day',
            'description' => 'description',
            'body_part'   => 'Stretch Breaks and Micro Movements',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/15',
            'link'        => 'https://youtu.be/-es9VDr_31E',
            'category_id' => 6
        ]);
        Exercise::create([
            'name'        => 'Stretch Breaks at Your Desk',
            'description' => 'description',
            'body_part'   => 'Stretch Breaks and Micro Movements',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/16',
            'link'        => 'https://youtu.be/vE1idGTZOIY',
            'category_id' => 6
        ]);
        //====================================================================================================
        Exercise::create([
            'name'        => '5-Minute Meditation You Can Do Anywhere',
            'description' => 'description',
            'body_part'   => 'Mental Health and Mindfulness',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/17',
            'link'        => 'https://youtu.be/inpok4MKVLM',
            'category_id' => 7
        ]);
        Exercise::create([
            'name'        => 'Meditation You Can Do Anywhere',
            'description' => 'description',
            'body_part'   => 'Mental Health and Mindfulness',
            'repetitions' => 12,
            'sets'        => 12,
            'duration'    => 12,
            'cover'       => 'assets/exercises/covers/18',
            'link'        => 'https://youtu.be/inpok4MKVLM',
            'category_id' => 7
        ]);
    }
}
