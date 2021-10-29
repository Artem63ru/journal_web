<?php

namespace App\Http\Controllers;

use App\Models\TableObj;
use Illuminate\Http\Request;

class MainTableController extends Controller
{
    public function index()
    {
        return view('main_table');
    }

    public function getMainTableInfo(Request $request){
        $namepar1=TableObj::select('namepar1')->where('id', '=', $request->id)->get(1);
        $table=TableObj::select('id',
            'hfrpok',
            'namepar1',
            'inout',
            'name_str',
            'shortname'
        )->where('namepar1', '=', $namepar1[0]->namepar1)->orderBy('id')->get();
        return $table;
    }
}

?>
