<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\TeamRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;

class TeamController extends Controller
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
            $team = Team::select([
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

            $response = $team->toArray();

            $response["recordsTotal"]    = $team->total();
            $response["recordsFiltered"] = $team->total();
            return $response;
        }
        return view("admin.teams.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.teams.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {

        $path = $request->file("logo")->store("teams");

        Team::create([
            "name" => $request->name,
            "club_state" => $request->club_state,
            "logo_uri" => $path
        ]);

        return redirect()->route('team.index')->withSuccess("Team added successfully");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $data['team'] = Team::with([
            'points'
        ])->findOrFail($id);
        return view("admin.teams.detail")->with($data);
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
        $data['team'] = Team::findOrFail($id);
        return view("admin.teams.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {

        $id = base64_decode($id);
        $team = Team::findOrFail($id);

        DB::transaction(function () use($request,$team) {
            if($request->file('logo')){
                Storage::delete($team->logo_uri);
                $path = $request->file("logo")->store("teams");
                $team->logo_uri = $path;
            }
            $team->name = $request->name;
            $team->club_state = $request->club_state;
            $team->save();
        });

        return redirect()->route('team.index')->withSuccess("Team updated successfully");


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

        $team = Team::findOrFail($id);

        Storage::delete($team->logo_uri);

        $team->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            "message" => "Team deleted successfully"
        ]);
    }
}
