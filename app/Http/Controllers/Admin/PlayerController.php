<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Http\Request;
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
                "name",
                "club_state",
                "logo_uri",
                "created_at",
                DB::raw('@rownum  := @rownum  + 1 AS rownum')

            ])
            ->when($request->search['value'],function($q) use($request){
                $q->where("name","LIKE","%{$request->search['value']}%")
                ->orWhere("club_state","LIKE","%{$request->search['value']}%");
            })
            ->orderBy($request->columns[$request->order[0]['column']]['name'],$request->order[0]['dir'])
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
            'name' => "required",
            "club_state" => "required",
            "logo" => "required"
        ]);

        $path = $request->file("logo")->store("Players");

        Player::create([
            "name" => $request->name,
            "club_state" => $request->club_state,
            "logo_uri" => $path
        ]);

        return redirect()->route('Player.index')->withSuccess("Player added successfully");
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
        $data['Player'] = Player::findOrFail($id);
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

        DB::transaction(function () use($request,$player) {
            if($request->file('logo')){
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

        Storage::delete($player->logo_uri);

        $player->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            "message" => "Player deleted successfully"
        ]);
    }
}
