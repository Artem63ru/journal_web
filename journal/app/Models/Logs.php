<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class Logs extends Model
{
    protected $table = 'public.logs';
    public $timestamps = true;
    public $primaryKey = 'id';
    protected $fillable = [
        'description', 'username','ip',
    ];

    //*************Запись в журнал при выходе из ссистемы
    public function setLogOutLog(){

        $this->insert(
            ['username' => Auth::user()->name,
                'description' => 'Пользователь вышел из системы',
                'ip'=>request()->getClientIp(),
                // 'role' =>Auth::user()->role,
                'created_at' =>Carbon::now(),
                 'session'=>request()->session()->getId()
            ]);

    }
    //*************Запись в журнал при входе в ссистемы
    public function setLogInLog(){
        $this->insert(
            ['username' => Auth::user()->name,
                'description' => 'Пользователь вошел в систему',
                'ip'=>request()->getClientIp(),
               // 'role' =>Auth::user()->role,
                'created_at' =>Carbon::now(),
                'session'=>request()->session()->getId()
            ]);
    }
    //*************Запись в журнал при попытке входа в ссистемы
    public function setLogAttemp(){
        $this->insert(
            ['username' =>request()->input('name'),
                'description' => 'Попытка входа в систему пользователя',
                'ip'=>request()->getClientIp(),
               // 'role' =>Auth::user()->role,
                'created_at' =>Carbon::now(),
                'session'=>request()->session()->getId()
            ]);
    }
    //*************Запись в журнал при блокировке входа в систему
    public function setLogLock(){
        $this->insert(
            ['username' => request()->input('name'),
                'description' => 'Блокировка входа в систему пользователя',
                'ip'=>request()->getClientIp(),
               // 'role' =>Auth::user()->role,
                'created_at' =>Carbon::now(),
                'session'=>request()->session()->getId()
            ]);
    }

}
