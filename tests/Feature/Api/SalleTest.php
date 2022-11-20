<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Salle;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalleTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_salles_list()
    {
        $salles = Salle::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.salles.index'));

        $response->assertOk()->assertSee($salles[0]->nom);
    }

    /**
     * @test
     */
    public function it_stores_the_salle()
    {
        $data = Salle::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.salles.store'), $data);

        $this->assertDatabaseHas('salles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_salle()
    {
        $salle = Salle::factory()->create();

        $data = [
            'nom' => $this->faker->text(255),
            'qte' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(route('api.salles.update', $salle), $data);

        $data['id'] = $salle->id;

        $this->assertDatabaseHas('salles', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_salle()
    {
        $salle = Salle::factory()->create();

        $response = $this->deleteJson(route('api.salles.destroy', $salle));

        $this->assertModelMissing($salle);

        $response->assertNoContent();
    }
}
