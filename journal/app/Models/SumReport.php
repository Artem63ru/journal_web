<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SumReport extends Model{
    protected $table='reports.summary_report';
    public $timestamps = false;
    public $primaryKey = 'id';
    protected $fillable = [
        'date', 'hour', 'p_out_nts', 'q_nts', 'p_out_yms', 'q_yms', 'q_full'
    ];



}
