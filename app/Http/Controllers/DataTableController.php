<?php

namespace App\Http\Controllers;

use App\Models\User;
use Yajra\DataTables\DataTables;



class DataTableController extends Controller
{
    public function datatables()
    {
        $users = User::select(['id', 'name', 'email']);

        return DataTables::of($users)
            ->addColumn('roles', function ($user) {
                return implode(', ', $user->getRoleNames()->toArray());
            })
            ->addColumn('action', function ($user) {
                return '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
