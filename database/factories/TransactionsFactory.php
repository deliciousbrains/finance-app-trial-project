<?php

namespace Database\Factories;

use App\Models\Transactions;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transactions::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>1,
            'label'=>$this->faker->company,
            'amount'=>$this->faker->randomFloat(2,0,100),
            'date'=>$this->faker->date("Y-m-d H:i:s")
        ];
    }
}
