<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryStoreTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->make();
    }

    public function test_store_category()
    {
        $this->withoutExceptionHandling();

        $data = factory(Category::class)->make()->toArray();

        $response = $this->actingAs($this->user)->post('/categories', $data);

        $response->assertRedirect('/categories');
        $this->assertCount(1, Category::all());
    }

    public function test_category_description_can_be_optional()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->user)->post('/categories', [
            'name' => 'Some name',
            'description' => ''
        ]);

        $response->assertRedirect('/categories');
        $this->assertCount(1, Category::all());
    }
}
