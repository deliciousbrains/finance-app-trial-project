<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewTransaction;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\TransactionController
 */
class TransactionControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $transactions = Transaction::factory()->count(3)->create();

        $response = $this->get(route('transaction.index'));

        $response->assertOk();
        $response->assertViewIs('dashboard');
        $response->assertViewHas('transactions');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\TransactionController::class,
            'store',
            \App\Http\Requests\TransactionStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $label = $this->faker->word;
        $amount = $this->faker->randomFloat(/** decimal_attributes **/);
        $occurred_at = $this->faker->dateTime();

        Event::fake();

        $response = $this->post(route('transaction.store'), [
            'label' => $label,
            'amount' => $amount,
            'occurred_at' => $occurred_at,
        ]);

        $transactions = Transaction::query()
            ->where('label', $label)
            ->where('amount', $amount)
            ->where('occurred_at', $occurred_at)
            ->get();
        $this->assertCount(1, $transactions);
        $transaction = $transactions->first();

        $response->assertRedirect(route('dashboard'));
        $response->assertSessionHas('transaction.label', $transaction->label);

        Event::assertDispatched(NewTransaction::class, function ($event) use ($transaction) {
            return $event->transaction->is($transaction);
        });
    }
}
