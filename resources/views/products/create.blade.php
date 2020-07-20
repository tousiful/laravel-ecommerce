@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('errors.errors')
            <div class="panel panel-default">
                <div class="panel-heading">Create a new Product</div>

                <div class="panel-body">
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                          <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="name" class="form-control" id="name" name="name" value="{{ old('name') }}">
                          </div>
                          <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price"  value="{{ old('price') }}">
                          </div>
                           <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                          </div>
                         <div class="form-group">
                              <label for="description">Discription:</label>
                              <textarea class="form-control" rows="5" id="description" name="description"> {{ old('description') }}</textarea>
                        </div>
                          <button type="submit" class="btn btn-success form-control">Save product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
