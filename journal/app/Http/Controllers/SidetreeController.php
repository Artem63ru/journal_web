<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GD_obj;
use App\Models\UF_obj;
use App\Models\UD_obj;
use App\Models\TableObj;

class SidetreeController extends Controller
{
    private function treeFormed($dom, $dict, $element, $level){
        $parent=$dom->createElement('ul');
        if ($level>1){
            $parent->setAttribute('hidden','true');
        }
        try{
            foreach ($dict['children'] as $value){
                    $element_li=$dom->createElement('li');
                    $a_node=$dom->createElement('a');
                    $a_node->textContent=$value['namepar1'];
                    $a_node->setAttribute('data-id', $value['id']);
                    $a_node->setAttribute('class', 'tableItem');
                    if (array_key_exists('children', $value)){
                        $plus_icon=$dom->createElement('img');
                        $plus_icon->setAttribute('class', 'treePlusIcon');
                        $plus_icon->setAttribute('src', asset('assets/images/icons/plus.png'));
                        $a_node->appendChild($plus_icon);
                    }

                    $element_li->appendChild($a_node);
                    $this->treeFormed($dom, $value, $element_li, $level+1);
                    $parent->appendChild($element_li);

            }
            $element->appendChild($parent);
        }
        catch (\Exception $err){

        }
    }

    public function getMinsParams(Request $request){
        $id=$request->id;
        try{
            $date = \DateTime::createFromFormat('Y-m-d H:i', $request->date);
            $date_end=\DateTime::createFromFormat('Y-m-d H:i', $request->date);
            $date_end->add(new \DateInterval('PT1H'));
            $childrens=TableObj::select('test_table.id as ObjId',
                'hfrpok',
                'parentId',
                '5min_params.val as min_val',
                '5min_params.timestamp as min_time')->
            where('parentId','=', $id)->
            leftJoin('app_info.5min_params', 'test_table.hfrpok', '=', '5min_params.hfrpok_id')->
            where('5min_params.timestamp', '>=', $date)->
            orderBy('ObjId')->
            orderBy('min_time')->
            get();
        }
        catch (\Exception $err){
            return $err;
        }
        $arr=array();
        foreach ($childrens as $row){
            if (!array_key_exists($row->ObjId, $arr)){
                $arr[$row->ObjId]=array('id'=>$row->ObjId,
                    'time_vals'=>[]);
            }
            $arr[$row->ObjId]['time_vals'][\DateTime::createFromFormat('Y-m-d H:i:s', $row->min_time)->format('H:i')]=$row->min_val;
        }
        return $arr;
    }

    public function test($id){
        $object=TableObj::select('test_table.id as ObjId',
            'hfrpok',
            'namepar1',
            'parentId',
            'sut_params.val as sut_val',
            'sut_params.timestamp as date',
            'hour_params.val as hour_val',
            'hour_params.timestamp as time')->
            leftJoin('app_info.sut_params', 'test_table.hfrpok', '=', 'sut_params.hfrpok_id')->
            where([['test_table.id','=', $id], ['sut_params.timestamp', '=', date('Y-m-d')]])->
            leftJoin('app_info.hour_params', 'test_table.hfrpok', '=', 'hour_params.hfrpok_id')->
            get();

        $childrens=TableObj::select('test_table.id as ObjId',
            'hfrpok',
            'namepar1',
            'parentId',
            'sut_params.val as sut_val',
            'sut_params.timestamp as date',
            'hour_params.val as hour_val',
            'hour_params.timestamp as time')->
            leftJoin('app_info.sut_params', 'test_table.hfrpok', '=', 'sut_params.hfrpok_id')->
            where([['parentId','=', $id], ['sut_params.timestamp', '=', date('Y-m-d')]])->
            leftJoin('app_info.hour_params', 'test_table.hfrpok', '=', 'hour_params.hfrpok_id')->
            where('hour_params.timestamp', '>=', date('Y-m-d'))->
            orderBy('ObjId')->
            orderBy('time')->
            get();

        $arr=array();
        foreach ($childrens as $row){
            if (!array_key_exists($row->ObjId, $arr)){
                $arr[$row->ObjId]=array('id'=>$row->ObjId,
                    'hfrpok'=>$row->hfrpok,
                    'namepar1'=>$row->namepar1,
                    'parentId'=>$row->parentId,
                    'sut_val'=>$row->sut_val,
                    'date'=>$row->date,
                    'time_vals'=>[]);
            }
            array_push($arr[$row->ObjId]['time_vals'], array('hour_val'=>$row->hour_val,'time'=>$row->time));
        }

        dd($arr);
    }

    public function getTableItemData(Request $request){
        $id=$request->id;
        $date=$request->date;
        $object=TableObj::select('test_table.id as ObjId',
            'hfrpok',
            'namepar1',
            'inout',
            'parentId',
            'name_str',
            'shortname',
            'sut_params.val as sut_val',
            'sut_params.timestamp as date',
            'hour_params.val as hour_val',
            'hour_params.timestamp as time')->
        leftJoin('app_info.sut_params', 'test_table.hfrpok', '=', 'sut_params.hfrpok_id')->
        where([['test_table.id','=', $id], ['sut_params.timestamp', '=', $date]])->
        leftJoin('app_info.hour_params', 'test_table.hfrpok', '=', 'hour_params.hfrpok_id')->
        get();

        $childrens=TableObj::select('test_table.id as ObjId',
            'hfrpok',
            'namepar1',
            'inout',
            'name_str',
            'shortname',
            'parentId',
            'sut_params.val as sut_val',
            'sut_params.timestamp as date',
            'hour_params.val as hour_val',
            'hour_params.timestamp as time')->
        leftJoin('app_info.sut_params', 'test_table.hfrpok', '=', 'sut_params.hfrpok_id')->
        where([['parentId','=', $id], ['sut_params.timestamp', '=', $date]])->
        leftJoin('app_info.hour_params', 'test_table.hfrpok', '=', 'hour_params.hfrpok_id')->
        where('hour_params.timestamp', '>=', $date)->
        orderBy('ObjId')->
        orderBy('time')->
        get();

        $arr=array();
        foreach ($childrens as $row){
            if (!array_key_exists($row->ObjId, $arr)){
                $arr[$row->ObjId]=array('id'=>$row->ObjId,
                    'hfrpok'=>$row->hfrpok,
                    'namepar1'=>$row->namepar1,
                    'inout'=>$row->inout,
                    'name_str'=>$row->name_str,
                    'shortname'=>$row->shortname,
                    'parentId'=>$row->parentId,
                    'sut_val'=>$row->sut_val,
                    'date'=>$row->date,
                    'time_vals'=>[]);
            }
            array_push($arr[$row->ObjId]['time_vals'], array('hour_val'=>$row->hour_val,'time'=>$row->time));
        }
        return $arr;
    }

    public function getSideTree(){
        $arr=TableObj::getTree();
        $dom=new \DOMDocument('1.0');
        $testTree=$dom->createElement('div');
        $testTree->setAttribute('style', 'margin-right: 10px');
        $level=1;
        $this->treeFormed($dom, $arr[0], $testTree, $level);

        return $dom->saveHTML($testTree);
    }

    public function getAllTable(){
//        $table=TableObj::all();
//        return $table;
    }
}

?>
