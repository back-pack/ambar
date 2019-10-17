<?php

namespace Tests\Feature;

use App\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentStoreTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->make();
    }

    public function test_store_payment()
    {
        $this->withoutExceptionHandling();

        $data = factory(Payment::class)->make()->toArray();

        $response = $this->actingAs($this->user)
            ->post('/payments', $data);

        $response->assertRedirect('/payments');
        $this->assertCount(1, Payment::all());
    }
}
