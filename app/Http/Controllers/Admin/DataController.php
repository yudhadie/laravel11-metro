<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
}
