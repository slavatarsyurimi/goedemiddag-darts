<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Resources\PlayerResource;

class PlayerController extends Controller
{
    /**
     * Return the list of all players.
     */
    public function index(): Response
    {
        $players = Player::all();

        return Inertia::render('players/PlayersIndex', [
            'players' => PlayerResource::collection($players),
        ]);
    }

    /**
     * Display the page for creating a new player.
     */
    public function create(): Response
    {
        return Inertia::render('players/PlayersCreate');
    }

    /**
     * Store a new player to the database.
     */
    public function store(Request $request)
    {
        // TODO: add validation;)
        Player::create([
            'full_name' => $request->get('full_name'),
        ]);
    }

    /**
     * Delete the given player.
     */
    public function destroy(Player $player): void
    {
        $player->delete();
    }
}
