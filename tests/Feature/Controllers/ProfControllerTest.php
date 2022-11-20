<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Prof;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfControllerTest extends TestCase
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
    public function it_displays_index_view_with_profs()
    {
        $profs = Prof::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('profs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.profs.index')
            ->assertViewHas('profs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_prof()
    {
        $response = $this->get(route('profs.create'));

        $response->assertOk()->assertViewIs('app.profs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_prof()
    {
        $data = Prof::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('profs.store'), $data);

        $this->assertDatabaseHas('profs', $data);

        $prof = Prof::latest('id')->first();

        $response->assertRedirect(route('profs.edit', $prof));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_prof()
    {
        $prof = Prof::factory()->create();

        $response = $this->get(route('profs.show', $prof));

        $response
            ->assertOk()
            ->assertViewIs('app.profs.show')
            ->assertViewHas('prof');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_prof()
    {
        $prof = Prof::factory()->create();

        $response = $this->get(route('profs.edit', $prof));

        $response
            ->assertOk()
            ->assertViewIs('app.profs.edit')
            ->assertViewHas('prof');
    }

    /**
     * @test
     */
    public function it_updates_the_prof()
    {
        $prof = Prof::factory()->create();

        $data = [
            'nom' => $this->faker->text(255),
        ];

        $response = $this->put(route('profs.update', $prof), $data);

        $data['id'] = $prof->id;

        $this->assertDatabaseHas('profs', $data);

        $response->assertRedirect(route('profs.edit', $prof));
    }

    /**
     * @test
     */
    public function it_deletes_the_prof()
    {
        $prof = Prof::factory()->create();

        $response = $this->delete(route('profs.destroy', $prof));

        $response->assertRedirect(route('profs.index'));

        $this->assertModelMissing($prof);
    }
}
