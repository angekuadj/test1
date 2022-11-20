<?php

namespace App\Http\Controllers\Api;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationCollection;

class ClasseReservationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Classe $classe)
    {
        $this->authorize('view', $classe);

        $search = $request->get('search', '');

        $reservations = $classe
            ->reservations()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReservationCollection($reservations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Classe $classe
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Classe $classe)
    {
        $this->authorize('create', Reservation::class);

        $validated = $request->validate([
            'salle_id' => ['nullable', 'exists:salles,id'],
        ]);

        $reservation = $classe->reservations()->create($validated);

        return new ReservationResource($reservation);
    }
}
