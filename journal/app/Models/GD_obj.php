<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GD_obj extends Model{
    protected $table='app_info.GD_obj';
    public $timestamps = true;
    public $primaryKey = 'id';
    protected $fillable = [
        'uf', 'desc', 'other',
    ];

    public static function getTree(){
        $data=GD_obj::select('GD_obj.id',
            'GD_obj.uf',
            'GD_obj.desc as uf_desc',
            'GD_obj.other as uf_data',
            'UF_obj.ud',
            'UF_obj.desc as ud_desc',
            'UF_obj.other as ud_data',
            'UD_obj.name as obj_name',
            'UD_obj.desc as obj_desc',
            'UD_obj.other as obj_data')->
        leftJoin('app_info.UF_obj', 'GD_obj.id', '=', 'UF_obj.from_UF')->
        leftJoin('app_info.UD_obj', 'UF_obj.id', '=', 'UD_obj.from_UD')->get();

        $result=['Main'=>['Name'=>'ГД Надым', 'childrens'=>[]]];

        foreach($data as $d){
            if (array_key_exists($d->uf, $result['Main']['childrens'])==false){
                $result['Main']['childrens'][$d->uf]=['Desc'=>$d->uf_desc, 'Data'=>$d->uf_data, 'childrens'=>[]];
            }
            if (array_key_exists($d->ud, $result['Main']['childrens'][$d->uf]['childrens'])==false){
                $result['Main']['childrens'][$d->uf]['childrens'][$d->ud]=['Desc'=>$d->ud_desc, 'Data'=>$d->ud_data, 'childrens'=>[]];
            }
            if (array_key_exists($d->obj_name, $result['Main']['childrens'][$d->uf]['childrens'][$d->ud]['childrens'])==false){
                $result['Main']['childrens'][$d->uf]['childrens'][$d->ud]['childrens'][$d->obj_name]=['Desc'=>$d->obj_desc, 'Data'=>$d->obj_data];
            }
        }

        return $result;
    }


}

?>
