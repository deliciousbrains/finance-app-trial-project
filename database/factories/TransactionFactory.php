<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'user_id' => User::find(1),
            'label' => ucfirst($this->faker->word()),
            'performed_at' => $this->faker->dateTime(),
            'amount' => $this->faker->randomFloat(2),
        ];
    }
}
