<?php

namespace dolar\Activitylog\Listeners;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\DB;

class LoginListener
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle(Login $event)
    {
        $user = $event->user;
        $dateTime = date('Y-m-d H:i:s');
        
        // $user_array = [
        //     'id' => auth()->user()->id ?? '',
        //     'name' => auth()->user()->name ?? '',
        //     'designation' => auth()->user()->designation ?? '',
        //     'officeNameEng' => auth()->user()->officeNameEng ?? '',
        //     'officeNameBng' => auth()->user()->officeNameBng ?? ''
        // ];
        $userInfo = json_encode(auth()->user());

        $data = [
            'ip'         => $this->request->ip(),
            'user_agent' => $this->request->userAgent()
        ];
        DB::table('logtrackers')->insert([
            'users'      => $userInfo, // Need to add this filed in database field type text/VARCHAR(250)
            'user_id'    => $user->id,
            'log_date'   => $dateTime,
            'table_name' => 'users',
            'log_type'   => 'login',
            'data'       => json_encode($data)
        ]);
    }
}