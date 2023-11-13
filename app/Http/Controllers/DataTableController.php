<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Yajra\DataTables\DataTables;

class DataTableController extends Controller
{
    public function users()
    {
        $users = User::select(['id', 'name', 'email', 'role']);

        return DataTables::of($users)

            ->addColumn('action', function ($user) {
                return '<a href="'.route('admin.users.edit', $user->id).'" class="btn btn-primary">Edit</a>';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function products()
    {
        $products = Product::select(['id', 'name', 'description', 'price', 'image']);

        return DataTables::of($products)
            ->addColumn('image', function ($product) {
                $imageUrl = asset('storage/app/public/'.$product->image);

                return '<img src="'.$imageUrl.'" alt="Product Image" style="max-width: 100px; max-height: 100px;">';
            })
            ->addColumn('action', function ($product) {
                if (auth()->user()->can('permission', ['update product'])) {
                    $edit = '<a href="'.route('admin.products.edit', $product->id).'" class="btn btn-primary">Edit</a>';
                } else {
                    $edit = '<a disabled class=" btn btn-secondary">Unable to Edit</a>';
                }
                if (auth()->user()->can('permission', ['delete product'])) {
                    $delete = '<a href="'.route('admin.products.destroy', $product->id).'" class="btn btn-danger">Delete</a>';
                } else {
                    $delete = '<a disabled class=" btn btn-secondary">Ubanle to Delete</a>';
                }
                $action = $edit.$delete;

                return $action;
            })
            ->rawColumns(['image', 'action'])
            ->make(true);
    }
}
