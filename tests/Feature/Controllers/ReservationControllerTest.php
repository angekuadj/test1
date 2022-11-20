<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Reservation;

use App\Models\Salle;
use App\Models\Classe;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReservationControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_reservations()
    {
        $reservations = Reservation::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('reservations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.reservations.index')
            ->assertViewHas('reservations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_reservation()
    {
        $response = $this->get(route('reservations.create'));

        $response->assertOk()->assertViewIs('app.reservations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_reservation()
    {
        $data = Reservation::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('reservations.store'), $data);

        unset($data['Ddebut']);
        unset($data['Dfin']);
        unset($data['user_id']);

        $this->assertDatabaseHas('reservations', $data);

        $reservation = Reservation::latest('id')->first();

        $response->assertRedirect(route('reservations.edit', $reservation));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_reservation()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservations.show', $reservation));

        $response
            ->assertOk()
            ->assertViewIs('app.reservations.show')
            ->assertViewHas('reservation');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_reservation()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->get(route('reservations.edit', $reservation));

        $response
            ->assertOk()
            ->assertViewIs('app.reservations.edit')
            ->assertViewHas('reservation');
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

        $response = $this->put(
            route('reservations.update', $reservation),
            $data
        );

        unset($data['Ddebut']);
        unset($data['Dfin']);
        unset($data['user_id']);

        $data['id'] = $reservation->id;

        $this->assertDatabaseHas('reservations', $data);

        $response->assertRedirect(route('reservations.edit', $reservation));
    }

    /**
     * @test
     */
    public function it_deletes_the_reservation()
    {
        $reservation = Reservation::factory()->create();

        $response = $this->delete(route('reservations.destroy', $reservation));

        $response->assertRedirect(route('reservations.index'));

        $this->assertModelMissing($reservation);
    }
}
