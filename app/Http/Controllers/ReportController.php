<?php

namespace App\Http\Controllers;

use App\Borrow;
use App\Detail_borrow;
use App\Broken;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
    	return view('report.index');
    }

    public function generate($param)
    {
    	if ($param == "all") {
    		return view('report.report', [
    			'type' => $param,
    			'data' => Borrow::latest()->get(),
    		]);
    	}elseif($param == "today"){
    		return view('report.report', [
    			'type' => $param,
    			'data' => Borrow::whereRaw('DATE(created_at) = CURDATE()')->latest()->get(),
    		]);
    	}else{
    		$data = DB::table('brokens')
    		->join('inventaries', 'brokens.inventary_id', '=', 'inventaries.id')
    		->select('inventaries.name', 'inventaries.inventary_code', 'inventaries.register_date', 'brokens.mount', 'brokens.created_at')
    		->latest()
    		->get();

    		return view('report.report', [
    			'type' => $param,
    			'data' => $data,
    		]);
    	}
    }

}
