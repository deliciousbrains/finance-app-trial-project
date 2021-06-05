<?php

namespace Database\Factories;

use App\Models\Transaction;
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
            'label' => 'Initial Deposit',
            'date' => $this->faker->dateTimeThisMonth(),
            'value' => $this->faker->randomFloat(2, -9000, 9900),
            'account_id' => 1,
        ];
    }
}
