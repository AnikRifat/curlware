@extends('admin.app.app')
@section('main-content')
    <div class="row">
        <div class="col-lg-12 order-0">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ isset($role) ? 'Edit Role' : 'Create Role' }}</h4>
                    <form action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"
                        method="POST">
                        @csrf
                        @if (isset($role))
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Role Name:</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ isset($role) ? $role->name : old('name') }}">
                        </div>

                        <div class="form-group">
                            <label for="permissions">Permissions:</label>
                            <select name="permissions[]" multiple class="form-control">
                                @foreach ($permissions as $permission)
                                    <option value="{{ $permission->name }}"
                                        {{ isset($role) && $role->hasPermissionTo($permission->name) ? 'selected' : '' }} multiple>
                                        {{ $permission->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit"
                            class="btn btn-primary">{{ isset($role) ? 'Update Role' : 'Create Role' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
