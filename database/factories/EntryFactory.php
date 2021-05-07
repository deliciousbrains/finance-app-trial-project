<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'label' => $this->faker->word,
            'value' => $this->faker->regexify('/\d+\.\d{2}/'),
            'date' => $this->faker->dateTime,
            'user_id' => function () {
                /** @var User $user */
                $user = User::factory()->create();
                return $user->id;
            },
        ];
    }
}
