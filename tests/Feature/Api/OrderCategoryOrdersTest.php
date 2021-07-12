<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderCategory;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class OrderCategoryOrdersTest extends TestCase
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
    public function it_gets_order_category_orders()
    {
        $orderCategory = OrderCategory::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'order_category_id' => $orderCategory->id,
            ]);

        $response = $this->getJson(
            route('api.order-categories.orders.index', $orderCategory)
        );

        $response->assertOk()->assertSee($orders[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_order_category_orders()
    {
        $orderCategory = OrderCategory::factory()->create();
        $data = Order::factory()
            ->make([
                'order_category_id' => $orderCategory->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.order-categories.orders.store', $orderCategory),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($orderCategory->id, $order->order_category_id);
    }
}
