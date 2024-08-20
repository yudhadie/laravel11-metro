<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function user()
    {
        $data = User::query();

        return datatables()->of($data)
        ->addColumn('action', 'admin.setting.user.action')
        ->addIndexColumn()
        ->addColumn('status', function($x){
            if ($x->active == 1) {
                return'<span class="text-success">Active</span>';
            }else {
                return'<span class="text-danger">Inactive</span>';
            }
        })
        ->addColumn('role', function($x){
            return $x->role;
        })
        ->rawColumns(['action','status'])
        ->toJson();
    }

    public function activity()
    {
        $data = Activity::query()
            ->with('user')
            ->select('id','log_name','description','subject_id','event','causer_id','created_at');

        return datatables()->of($data)
        ->addIndexColumn()
        ->addColumn('user', function($data){
            if ($data->causer_id != null) {
                $user = $data->user->name;
            } else {
                $user = '-';
            }
            return $user;
        })
        ->addColumn('time', function($data){
            // return Carbon::parse($data->created_at)->diffForHumans();
            return $data->created_at->diffForHumans();
        })
        ->toJson();
    }
}
