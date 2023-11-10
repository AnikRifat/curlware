<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\DataTables;



class DataTableController extends Controller
{
    public function users()
    {
        $users = User::select(['id', 'name', 'email', 'role']);

        return DataTables::of($users)

            ->addColumn('action', function ($user) {
                return '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
