<!-- resources/views/admin/products/edit.blade.php -->

@extends('admin.app.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"
        integrity="sha512-EZSUkJWTjzDlspOoPSpUFR0o0Xy7jdzW//6qhUkoZ9c4StFkVsp9fbbd0O06p9ELS3H486m4wmrCELjza4JEog=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('main-content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">{{ $product ? 'Edit Product' : 'Create Product' }}</h4>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form
                        action="{{ $product ? route('admin.products.update', $product->id) : route('admin.products.store') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if ($product)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" value="{{ $product ? $product->name : old('name') }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control">{{ $product ? $product->description : old('description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="text" name="price" value="{{ $product ? $product->price : old('price') }}"
                                class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="image">Product Image:</label>
                            <input type="file" name="image" class="dropify"
                                data-default-file="{{ $product ? asset('storage/app/public/' . $product->image) : '' }}">
                        </div>

                        <!-- Add more fields as needed -->

                        <button type="submit"
                            class="btn btn-primary">{{ $product ? 'Update Product' : 'Create Product' }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"
            integrity="sha512-8QFTrG0oeOiyWo/VM9Y8kgxdlCryqhIxVeRpWSezdRRAvarxVtwLnGroJgnVW9/XBRduxO/z1GblzPrMQoeuew=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                $('.dropify').dropify();
            });
        </script>
    @endpush
@endsection
