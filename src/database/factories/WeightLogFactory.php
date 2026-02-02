<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-60 days', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 70, 80),
            'calories' => $this->faker->numberBetween(1000, 3000),
            'exercise_time' => $this->faker->time('H:i'),
            'exercise_content' => $this->faker->randomElement([
                'ウォーキング',
                'ジョギング',
                'ストレッチと体幹トレーニング',
                '筋トレ（腹筋・腕立て）',
                'ヨガ',
                'サイクリング',
                '階段昇降',
            ]),
        ];
    }
}
