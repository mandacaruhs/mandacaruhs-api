<?php

namespace App\Http\Controllers;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\StatusPorta;

class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index() 
    {
        $statusPorta = StatusPorta::whereRaw("stp_data_cadastro >= NOW() - 1800")
				  ->orderBy('status_porta_id', 'desc')
				  ->first();

        if($statusPorta) 
	{
	    $daily = StatusPorta::select(DB::raw('TIME_TO_SEC(TIME(stp_data_cadastro)) AS time'), 'stp_status')
				->whereRaw("DATE(stp_data_cadastro) = CURDATE()")
				->get()->toArray();

	    $timeline = array_fill(0, 288, -1);

	    foreach($daily as $time) {
		$index = floor(intval($time['time']) / 300);
		$timeline[$index] = [$time['stp_status'], gmdate('H:i', $time['time'])];
	    }

	    Carbon::setLocale('pt_BR');
	    $carbon = Carbon::instance($statusPorta->stp_data_cadastro);

            return response()->json([ 
                'status'   => $statusPorta->stp_status, 
                'time'     => $carbon->diffForHumans(Carbon::now()), 
		'timeline' => $timeline,
            ]);
        }

        return response()->json([ 'status' => -1 ]);
    }

    public function store(Request $request) 
    {
        $status = $request->input('status');
        
        if($status != 0 && $status != 1) {
            return response()->json(['error' => 'Invalid status.'], 400);
        }

        StatusPorta::create([
            'stp_status' => $status,
        ]);

        return response()->json([ 'success' => true ]);
    }
}
