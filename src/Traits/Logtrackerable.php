<?php
namespace dolar\Activitylog\Traits;

use stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\User;

trait Logtrackerable
{
    static protected $logTable = 'logtrackers';
    
    
    static function logToDatabase($model, $logType)
    {
        // if (!Session::has('user') || $model->excludeLogging) return;
        if ($logType == 'create') $originalData = json_encode($model);
        else {
            if (version_compare(app()->version(), '7.0.0', '>='))
            $originalData = json_encode($model->getRawOriginal()); // getRawOriginal available from Laravel 7.x
            else
            $originalData = json_encode($model->getOriginal());
        }
        
        

        $tableName = $model->getTable();
        $dateTime = date('Y-m-d H:i:s');

        /************This code only for phGov project (services)************/ 
        
        $d = json_decode($originalData);
        $serviceId = $d->id;
        $service_id = $tableName == 'service' ? $serviceId : '';
        /************End code only for phGov project (services)************/ 

        $userId = auth()->check() ? auth()->user()->id : Session::get('user')['id'] ?? 1; //For SSO login Or Admin Login
        
        // $user_array = [
        //     'id' => $userInfo['id'],
        //     'name' => $userInfo['userName'],
        //     'designation' => $userInfo['designation'],
        //     'officeNameEng' => $userInfo['officeNameEng'],
        //     'officeNameBng' => $userInfo['officeNameBng']
        // ];
        $userdata=User::find(auth()->user()->id);
  


        $user_array = [
            'id' => auth()->user()->id ?? '',
            'name' => auth()->user()->name ?? ''           
        ];

        $userInfo = json_encode($user_array);

        /** New Data Track when edit */
        $new_data = '';
        if( $logType == 'edit' ) {
            $new_data = DB::table($tableName)->where('id',$serviceId)->first();
        }

        DB::table(self::$logTable)->insert([
            'users'              => $userdata ?? '',             
            'user_id'            => $userId,
            'username'            => auth()->user()->name,
            'log_date'           => $dateTime,
            'table_name'         => $tableName,
            'log_type'           => $logType,
            'new_data'           => json_encode($new_data),
            'data'               => $originalData
        ]);
    }

    
    public static function bootLogtrackerable()
    {
        // When data updated
        self::updated(function ($model) {
            self::logToDatabase($model, 'edit');
        });

        // When Data deleted
        self::deleted(function ($model) {
            self::logToDatabase($model, 'delete');
        });


        // When data Created
        self::created(function ($model) {
            self::logToDatabase($model, 'create');
        });
        

    }
}
