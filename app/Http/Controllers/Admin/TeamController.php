<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
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
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
            "club_state" => "required",
            "logo" => "required"
        ]);

        $path = $request->file("logo")->store(public_path("teams"));

        Team::create([
            "name" => $request->name,
            "club_state" => $request->club_state,
            "logo_uri" => $path
        ]);

        return redirect()->route("team.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
