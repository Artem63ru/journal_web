<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GD_obj;

class MenuController extends Controller
{
   public function index()
   {
       $side_tree_data=GD_obj::getTree();
       return view('time_params');
//       return view('time_params', compact('side_tree_data'));
   }
}

?>
