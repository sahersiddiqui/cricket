<?php

namespace App\Http\Controllers\Admin;

use App\Models\Team;
use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MatchRequest;
use App\Http\Controllers\Controller;

class MatchController extends Controller
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
            $player = Match::select([
                "id",
                "first_team_id" ,
                "second_team_id" ,
                "match_date" ,
                "result" ,
                "created_at",
                DB::raw('@rownum  := @rownum  + 1 AS rownum')

            ])
            ->with([
                'firstTeam',
                'secondTeam',
            ])
                ->when($request->search['value'], function ($q) use ($request) {
                    $q->whereHas("firstTeam",function($v) use ($request){
                        $v->where("name","LIKE","%{$request->search['value']}%");
                    })->OrWhereHas("secondTeam",function($v) use ($request){
                        $v->where("name","LIKE","%{$request->search['value']}%");
                    });

                })
                ->orderBy($request->columns[$request->order[0]['column']]['name'], $request->order[0]['dir'])
                ->paginate($request->length);

            $response = $player->toArray();

            $response["recordsTotal"]    = $player->total();
            $response["recordsFiltered"] = $player->total();
            return $response;
        }
        return view("admin.matches.list");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['teams'] = Team::get();
        return view("admin.matches.add")->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchRequest $request)
    {
        DB::transaction(function () use ($request) {
            $match = Match::create([
                "first_team_id" => $request->first_team,
                "second_team_id" => $request->second_team,
                "match_date" => $request->match_date,
                "result" => $request->result,
            ]);

            if ($request->result == WINNER) {
                $match->point()->create([
                    'team_id' => $request->winner == "first_team" ? $request->second_team : $request->first_team,
                    "points" => POINTS['lose']
                ]);

                $match->point()->create([
                    'team_id' => $request->{$request->winner},
                    "points" => POINTS['win']
                ]);
                
            }else{
                $match->point()->create([
                    'team_id' => $request->first_team,
                    "points" => POINTS['draw']
                ]);
                $match->point()->create([
                    'team_id' => $request->second_team,
                    "points" => POINTS['draw']
                ]);
            }
        });

        return redirect()->route("match.index")->with(['success' => "Match Added successfully"]);
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
        $id = base64_decode($id);
        $data['match'] = Match::with(['point' => function($q){
            $q->where("points", POINTS['win']);
        }])->findOrFail($id);
        $data['teams'] = Team::get();

        return view("admin.matches.edit")->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatchRequest $request, $id)
    {
        $id = base64_decode($id);
        $match = Match::findOrFail($id);

        DB::transaction(function () use ($request,$match) {
            $match->update([
                "first_team_id" => $request->first_team,
                "second_team_id" => $request->second_team,
                "match_date" => $request->match_date,
                "result" => $request->result,
            ]);

            $match->point()->delete();

            if ($request->result == WINNER) {
                $match->point()->create([
                    'team_id' => $request->winner == "first_team" ? $request->second_team : $request->first_team,
                    "points" => POINTS['lose']
                ]);

                $match->point()->create([
                    'team_id' => $request->{$request->winner},
                    "points" => POINTS['win']
                ]);
                
            }else{
                $match->point()->create([
                    'team_id' => $request->first_team,
                    "points" => POINTS['draw']
                ]);
                $match->point()->create([
                    'team_id' => $request->second_team,
                    "points" => POINTS['draw']
                ]);
            }
        });

        return redirect()->route("match.index")->with(['success' => "Match updated successfully"]);
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

        $team = Match::findOrFail($id);

        $team->delete();

        return response()->json([
            'status' => Response::HTTP_OK,
            "message" => "Match deleted successfully"
        ]);
    }
}
