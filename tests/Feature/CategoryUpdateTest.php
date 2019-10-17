<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = factory(\App\User::class)->make();

        $this->category = factory(Category::class)->create();
    }


    public function test_update_category()
    {
        $this->withoutExceptionHandling();

        $name = 'Testing name';
        $description = 'Testing description';

        $response = $this->actingAs($this->user)->patch("/categories/{$this->category->id}", [
            'name' => $name,
            'description' => $description
        ]);

        $category = Category::first();

        $response->assertRedirect('/categories');
        $this->assertEquals($name, $category->name);
        $this->assertEquals($description, $category->description);
    }
}
