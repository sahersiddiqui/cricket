<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw("set @rownum=$request->start"));
            $player = Player::select([
                "id",
                "firstname",
                "lastname",
                "image_uri",
                "country",
                DB::raw('@rownum  := @rownum  + 1 AS rownum')

            ])
                ->when($request->search['value'], function ($q) use ($request) {
                    $q->where("name", "LIKE", "%{$request->search['value']}%")
                        ->orWhere("club_state", "LIKE", "%{$request->search['value']}%");
                })
                ->orderBy($request->columns[$request->order[0]['column']]['name'], $request->order[0]['dir'])
                ->paginate($request->length);

            $response = $player->toArray();

            $response["recordsTotal"]    = $player->total();
            $response["recordsFiltered"] = $player->total();
            return $response;
        }
        return view("admin.players.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['teams'] = Team::get();
        return view("admin.players.add")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => "required",
            'last_name' => "required",
            'country' => "required",
            'jersey_number' => "required|integer",
            'matches' => "required|integer",
            'image' => "required",
            'team_id' => "required",
        ]);

        $path = $request->file("image")->store("player");

        Player::create([
            'firstname' => $request->first_name,
            'lastname' => $request->last_name,
            'country' => $request->country,
            'jersey_number' => $request->jersey_number,
            'matches' => $request->matches,
            'image_uri' => $path,
            'team_id' => $request->team_id,
        ]);

        return redirect()->route('player.index')->withSuccess("Player added successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $data['player'] = Player::findOrFail($id);
        return view("admin.players.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => "required",
            "club_state" => "required",
        ]);

        $id = base64_decode($id);
        $player = Player::findOrFail($id);

        DB::transaction(function () use ($request, $player) {
            if ($request->file('logo')) {
                Storage::delete($player->logo_uri);
                $path = $request->file("logo")->store("Players");
                $player->logo_uri = $path;
            }
            $player->name = $request->name;
            $player->club_state = $request->club_state;
            $player->save();
        });

        return redirect()->route('Player.index')->withSuccess("Player updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = base64_decode($id);

        $player = Player::findOrFail($id);

        Storage::delete($player->image_uri);

        $player->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            "message" => "Player deleted successfully"
        ]);
    }
}
