<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UD_obj extends Model{
    protected $table='app_info.UD_obj';
    public $timestamps = true;
    public $primaryKey = 'id';
    protected $fillable = [
        'name', 'desc', 'from_UD', 'other',
    ];


}

?>

