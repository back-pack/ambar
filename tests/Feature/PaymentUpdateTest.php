<?php

namespace Tests\Feature;

use App\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->make();

        $this->payment = factory(Payment::class)->create();
    }

    public function test_update_payment()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)
            ->patch("/payments/{$this->payment->id}", [
                'client_id' => 2,
                'order_id' => 2,
                'amount' => 2
            ]);

        $payment = Payment::first();

        $response->assertRedirect('/payments');
        $this->assertEquals(2, $payment->client_id);
        $this->assertEquals(2, $payment->order_id);
        $this->assertEquals(2, $payment->amount);
    }
}
