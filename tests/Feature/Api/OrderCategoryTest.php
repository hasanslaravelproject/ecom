<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\OrderCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_order_categories_list()
    {
        $orderCategories = OrderCategory::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.order-categories.index'));

        $response->assertOk()->assertSee($orderCategories[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_order_category()
    {
        $data = OrderCategory::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.order-categories.store'), $data);

        $this->assertDatabaseHas('order_categories', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_order_category()
    {
        $orderCategory = OrderCategory::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.order-categories.update', $orderCategory),
            $data
        );

        $data['id'] = $orderCategory->id;

        $this->assertDatabaseHas('order_categories', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_order_category()
    {
        $orderCategory = OrderCategory::factory()->create();

        $response = $this->deleteJson(
            route('api.order-categories.destroy', $orderCategory)
        );

        $this->assertDeleted($orderCategory);

        $response->assertNoContent();
    }
}
