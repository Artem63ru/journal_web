<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TableObj extends Model{
    protected $table='app_info.test_table';
    public $timestamps = true;
    public $primaryKey = 'id';
    protected $fillable = [
        'hfrpok', 'namepar1', 'inout', 'name', 'shortname'
    ];


    static function createTree(&$list, $parent){
        $tree = array();
        foreach ($parent as $k=>$l){
            if(isset($list[$l['id']])){
                $l['children'] = TableObj::createTree($list, $list[$l['id']]);
            }
            $tree[] = $l;
        }
        return $tree;
    }

    public static function getTree(){
        $data=TableObj::select('id', 'hfrpok',
        'namepar1', 'parentId')->where('inout', '=', '!')->orderBy('parentId')->get();

        foreach ($data as $row){
            $arr[]=array('id'=>$row->id,
                'hfrpok'=>$row->hfrpok,
                'namepar1'=>$row->namepar1,
                'parentId'=>$row->parentId);
        }

        $new = array();
        foreach ($arr as $a){
            $new[$a['parentId']][] = $a;
        }
        $tree = TableObj::createTree($new, array($data[0]));

        return $tree;
    }

}

?>
