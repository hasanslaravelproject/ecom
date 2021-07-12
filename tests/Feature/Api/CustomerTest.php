<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;

use App\Models\Company;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
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
    public function it_gets_customers_list()
    {
        $customers = Customer::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.customers.index'));

        $response->assertOk()->assertSee($customers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer()
    {
        $data = Customer::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.customers.store'), $data);

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_customer()
    {
        $customer = Customer::factory()->create();

        $company = Company::factory()->create();

        $data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'passcode' => $this->faker->text(255),
            'comapany_id' => $company->id,
        ];

        $response = $this->putJson(
            route('api.customers.update', $customer),
            $data
        );

        $data['id'] = $customer->id;

        $this->assertDatabaseHas('customers', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer()
    {
        $customer = Customer::factory()->create();

        $response = $this->deleteJson(
            route('api.customers.destroy', $customer)
        );

        $this->assertDeleted($customer);

        $response->assertNoContent();
    }
}
