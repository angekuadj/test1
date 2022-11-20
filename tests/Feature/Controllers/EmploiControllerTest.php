<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Emploi;

use App\Models\Prof;
use App\Models\Salle;
use App\Models\Classe;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmploiControllerTest extends TestCase
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
    public function it_displays_index_view_with_emplois()
    {
        $emplois = Emploi::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('emplois.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.emplois.index')
            ->assertViewHas('emplois');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_emploi()
    {
        $response = $this->get(route('emplois.create'));

        $response->assertOk()->assertViewIs('app.emplois.create');
    }

    /**
     * @test
     */
    public function it_stores_the_emploi()
    {
        $data = Emploi::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('emplois.store'), $data);

        $this->assertDatabaseHas('emplois', $data);

        $emploi = Emploi::latest('id')->first();

        $response->assertRedirect(route('emplois.edit', $emploi));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_emploi()
    {
        $emploi = Emploi::factory()->create();

        $response = $this->get(route('emplois.show', $emploi));

        $response
            ->assertOk()
            ->assertViewIs('app.emplois.show')
            ->assertViewHas('emploi');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_emploi()
    {
        $emploi = Emploi::factory()->create();

        $response = $this->get(route('emplois.edit', $emploi));

        $response
            ->assertOk()
            ->assertViewIs('app.emplois.edit')
            ->assertViewHas('emploi');
    }

    /**
     * @test
     */
    public function it_updates_the_emploi()
    {
        $emploi = Emploi::factory()->create();

        $classe = Classe::factory()->create();
        $salle = Salle::factory()->create();
        $user = User::factory()->create();
        $prof = Prof::factory()->create();

        $data = [
            'Ddebut' => $this->faker->text(255),
            'Dfin' => $this->faker->text(255),
            'classe_id' => $classe->id,
            'salle_id' => $salle->id,
            'user_id' => $user->id,
            'prof_id' => $prof->id,
        ];

        $response = $this->put(route('emplois.update', $emploi), $data);

        $data['id'] = $emploi->id;

        $this->assertDatabaseHas('emplois', $data);

        $response->assertRedirect(route('emplois.edit', $emploi));
    }

    /**
     * @test
     */
    public function it_deletes_the_emploi()
    {
        $emploi = Emploi::factory()->create();

        $response = $this->delete(route('emplois.destroy', $emploi));

        $response->assertRedirect(route('emplois.index'));

        $this->assertModelMissing($emploi);
    }
}
