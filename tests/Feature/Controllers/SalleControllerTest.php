<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Salle;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalleControllerTest extends TestCase
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
    public function it_displays_index_view_with_salles()
    {
        $salles = Salle::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('salles.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.salles.index')
            ->assertViewHas('salles');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_salle()
    {
        $response = $this->get(route('salles.create'));

        $response->assertOk()->assertViewIs('app.salles.create');
    }

    /**
     * @test
     */
    public function it_stores_the_salle()
    {
        $data = Salle::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('salles.store'), $data);

        $this->assertDatabaseHas('salles', $data);

        $salle = Salle::latest('id')->first();

        $response->assertRedirect(route('salles.edit', $salle));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_salle()
    {
        $salle = Salle::factory()->create();

        $response = $this->get(route('salles.show', $salle));

        $response
            ->assertOk()
            ->assertViewIs('app.salles.show')
            ->assertViewHas('salle');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_salle()
    {
        $salle = Salle::factory()->create();

        $response = $this->get(route('salles.edit', $salle));

        $response
            ->assertOk()
            ->assertViewIs('app.salles.edit')
            ->assertViewHas('salle');
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

        $response = $this->put(route('salles.update', $salle), $data);

        $data['id'] = $salle->id;

        $this->assertDatabaseHas('salles', $data);

        $response->assertRedirect(route('salles.edit', $salle));
    }

    /**
     * @test
     */
    public function it_deletes_the_salle()
    {
        $salle = Salle::factory()->create();

        $response = $this->delete(route('salles.destroy', $salle));

        $response->assertRedirect(route('salles.index'));

        $this->assertModelMissing($salle);
    }
}
