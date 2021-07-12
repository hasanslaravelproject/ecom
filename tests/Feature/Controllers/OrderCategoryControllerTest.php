<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\OrderCategory;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_order_categories()
    {
        $orderCategories = OrderCategory::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('order-categories.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.order_categories.index')
            ->assertViewHas('orderCategories');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_order_category()
    {
        $response = $this->get(route('order-categories.create'));

        $response->assertOk()->assertViewIs('app.order_categories.create');
    }

    /**
     * @test
     */
    public function it_stores_the_order_category()
    {
        $data = OrderCategory::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('order-categories.store'), $data);

        $this->assertDatabaseHas('order_categories', $data);

        $orderCategory = OrderCategory::latest('id')->first();

        $response->assertRedirect(
            route('order-categories.edit', $orderCategory)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_order_category()
    {
        $orderCategory = OrderCategory::factory()->create();

        $response = $this->get(route('order-categories.show', $orderCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.order_categories.show')
            ->assertViewHas('orderCategory');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_order_category()
    {
        $orderCategory = OrderCategory::factory()->create();

        $response = $this->get(route('order-categories.edit', $orderCategory));

        $response
            ->assertOk()
            ->assertViewIs('app.order_categories.edit')
            ->assertViewHas('orderCategory');
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

        $response = $this->put(
            route('order-categories.update', $orderCategory),
            $data
        );

        $data['id'] = $orderCategory->id;

        $this->assertDatabaseHas('order_categories', $data);

        $response->assertRedirect(
            route('order-categories.edit', $orderCategory)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_order_category()
    {
        $orderCategory = OrderCategory::factory()->create();

        $response = $this->delete(
            route('order-categories.destroy', $orderCategory)
        );

        $response->assertRedirect(route('order-categories.index'));

        $this->assertDeleted($orderCategory);
    }
}
