<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Reservation;

use App\Models\Salle;
use App\Models\Classe;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationTest extends TestCase
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
    public function it_gets_reservations_list()
    {
        $reservations = Reservation::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.reservations.index'));

        $response->assertOk()->assertSee($reservations[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_reservation()
    {
        $data = Reservation::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.reservations.store'), $data);

        unset($data['Ddebut']);
        unset($data['Dfin']);
        unset($data['user_id']);

        $this->assertDatabaseHas('reservations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_reservation()
    {
        $reservation = Reservation::factory()->create();

        $classe = Classe::factory()->create();
        $salle = Salle::factory()->create();
        $user = User::factory()->create();

        $data = [
            'salle_id' => $this->faker->randomNumber,
            'classe_id' => $this->faker->randomNumber,
            'Ddebut' => $this->faker->text(255),
            'Dfin' => $this->faker->text(255),
            'classe_id' => $classe->id,
            'salle_id' => $salle->id,
            'user_id' => $user->id,
        ];

        $response = $this->putJson(
            route('api.reservations.update', $reservation),
            $data
        );

        unset($data['Ddebut']);
        unset($data['Dfin']);
        unset($data['user_id']);

        $data['id'] = $reservation->id;

        $this->assertDatabaseHas('reservations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_reservation()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->deleteJson(
            route('api.reservations.destroy', $reservation)
        );

        $this->assertModelMissing($reservation);

        $response->assertNoContent();
    }
}
