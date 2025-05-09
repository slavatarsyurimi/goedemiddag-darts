<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Player;
use App\Models\DartsMatch;
use Illuminate\Support\Arr;
use App\Http\Resources\PlayerResource;
use App\Http\Requests\Matches\StoreDartsMatchRequest;

class DartsMatchController extends Controller
{
    /**
     * Display the page for creating a new darts match.
     */
    public function create(): Response
    {
        $players = Player::all();

        return Inertia::render('matches/MatchCreate', [
            'players' => PlayerResource::collection($players),
        ]);
    }

    /**
     * Store a new darts match for the two given players.
     */
    public function store(StoreDartsMatchRequest $request)
    {
        $validated = $request->validated();

        $match = DartsMatch::create();
        $match->players()->attach([
            $validated['player_1_id'] => ['remainder_points' => DartsMatch::STARTING_POINTS],
            $validated['player_2_id'] => ['remainder_points' => DartsMatch::STARTING_POINTS],
        ]);

        $startingPlayerId = collect(Arr::only($validated, ['player_1_id', 'player_2_id']))
            ->random();

        $startingVisit = $match->visits()->create([
            'player_id' => $startingPlayerId,
            'order'     => 1,
        ]);
    }
}
