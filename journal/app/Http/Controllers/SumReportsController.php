<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SumReport;

class SumReportsController extends Controller
{
    public function index()
    {
        return view('sumreports');
    }

    public function getTable(Request $request){
        $date=$request->date;
        $tb=SumReport::select('*')->where('date', '=', $date)->get();
        return $tb;
    }
}

?>
