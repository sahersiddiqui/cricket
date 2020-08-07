<?php

namespace App\Http\Controllers\Admin;

use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PointController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            DB::statement(DB::raw("set @rownum=$request->start"));
            $player = Point::select([
                "team_id",
                "match_id",
                "points",
                DB::raw('@rownum  := @rownum  + 1 AS rownum')

            ])
                ->whereHas("match")
                ->whereHas("team")
                ->with(['team', 'match'])
                ->when($request->search['value'], function ($q) use ($request) {
                    $q->whereHas("team", function ($v) use ($request) {
                        $v->Where("name", "LIKE", "%{$request->search['value']}%");
                    });
                })
                ->orderBy($request->columns[$request->order[0]['column']]['name'], $request->order[0]['dir'])
                ->paginate($request->length);

            $response = $player->toArray();

            $response["recordsTotal"]    = $player->total();
            $response["recordsFiltered"] = $player->total();
            return $response;
        }
        return view("admin.points.list");
    }
}
