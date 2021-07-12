<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Order;
use App\Models\MenuType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuTypeOrdersTest extends TestCase
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
    public function it_gets_menu_type_orders()
    {
        $menuType = MenuType::factory()->create();
        $orders = Order::factory()
            ->count(2)
            ->create([
                'menu_type_id' => $menuType->id,
            ]);

        $response = $this->getJson(
            route('api.menu-types.orders.index', $menuType)
        );

        $response->assertOk()->assertSee($orders[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_menu_type_orders()
    {
        $menuType = MenuType::factory()->create();
        $data = Order::factory()
            ->make([
                'menu_type_id' => $menuType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.menu-types.orders.store', $menuType),
            $data
        );

        $this->assertDatabaseHas('orders', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $order = Order::latest('id')->first();

        $this->assertEquals($menuType->id, $order->menu_type_id);
    }
}
