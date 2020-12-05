<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'label' => implode(' ', $this->faker->words),
            'amount' => $this->faker->randomFloat(2, 0, 500),
            'occurred_at' => $this->faker->dateTimeThisMonth
        ];
    }
}
