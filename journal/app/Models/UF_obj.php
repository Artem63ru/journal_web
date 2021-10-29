<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UF_obj extends Model{
    protected $table='app_info.UF_obj';
    public $timestamps = true;
    public $primaryKey = 'id';
    protected $fillable = [
        'ud', 'desc', 'from_UF','other',
    ];


}

?>
