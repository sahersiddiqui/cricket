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
                ->with(['team'])
                ->when($request->search['value'], function ($q) use ($request) {
                    $q->where("firstname", "LIKE", "%{$request->search['value']}%")
                        ->orWhere("lastname", "LIKE", "%{$request->search['value']}%")
                        ->orWhere("country", "LIKE", "%{$request->search['value']}%");
                })
                ->when($request->team_id, function ($q) use ($request) {
                    $q->where("team_id", $request->team_id);
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
}
