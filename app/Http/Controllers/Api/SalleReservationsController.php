<?php

namespace App\Http\Controllers\Api;

use App\Models\Salle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ReservationResource;
use App\Http\Resources\ReservationCollection;

class SalleReservationsController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Salle $salle)
    {
        $this->authorize('view', $salle);

        $search = $request->get('search', '');

        $reservations = $salle
            ->salles()
            ->search($search)
            ->latest()
            ->paginate();

        return new ReservationCollection($reservations);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Salle $salle
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Salle $salle)
    {
        $this->authorize('create', Reservation::class);

        $validated = $request->validate([
            'classe_id' => ['required', 'exists:classes,id'],
        ]);

        $reservation = $salle->salles()->create($validated);

        return new ReservationResource($reservation);
    }
}
