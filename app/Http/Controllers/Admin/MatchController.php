<?php

namespace App\Http\Controllers\Admin;

use App\Models\Match;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
                "firstname",
                "lastname",
                "image_uri",
                "country",
                DB::raw('@rownum  := @rownum  + 1 AS rownum')

            ])
                ->when($request->search['value'], function ($q) use ($request) {
                    $q->where("firstname", "LIKE", "%{$request->search['value']}%")
                    ->orWhere("lastname", "LIKE", "%{$request->search['value']}%")
                    ->orWhere("country", "LIKE", "%{$request->search['value']}%");
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
