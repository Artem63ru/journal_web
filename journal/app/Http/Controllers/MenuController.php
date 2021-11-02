<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GD_obj;

class MenuController extends Controller
{
   public function index()
   {
       return view('time_params');
//       return view('time_params', compact('side_tree_data'));
   }
}

?>
