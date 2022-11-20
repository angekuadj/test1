<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Salle;
use App\Models\Reservation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalleReservationsTest extends TestCase
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
    public function it_gets_salle_reservations()
    {
        $salle = Salle::factory()->create();
        $reservations = Reservation::factory()
            ->count(2)
            ->create([
                'salle_id' => $salle->id,
            ]);

        $response = $this->getJson(
            route('api.salles.reservations.index', $salle)
        );

        $response->assertOk()->assertSee($reservations[0]->Ddebut);
    }

    /**
     * @test
     */
    public function it_stores_the_salle_reservations()
    {
        $salle = Salle::factory()->create();
        $data = Reservation::factory()
            ->make([
                'salle_id' => $salle->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.salles.reservations.store', $salle),
            $data
        );

        unset($data['Ddebut']);
        unset($data['Dfin']);
        unset($data['user_id']);

        $this->assertDatabaseHas('reservations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $reservation = Reservation::latest('id')->first();

        $this->assertEquals($salle->id, $reservation->salle_id);
    }
}
