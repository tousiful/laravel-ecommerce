@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('errors.errors')
            <div class="panel panel-default">
                <div class="panel-heading">Update Product</div>

                <div class="panel-body">
                    <form action="{{ route('products.update', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">

                        {{ csrf_field() }}

                        {{ method_field('PUT')}}

                          <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="name" class="form-control" id="name" name="name" value="{{ $product->name }}">
                          </div>
                          <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" class="form-control" id="price" name="price"  value="{{ $product->price }}">
                          </div>
                           <div class="form-group">
                            <label for="image">Image:</label>
                            <input type="file" class="form-control" id="image" name="image">
                          </div>
                         <div class="form-group">
                              <label for="description">Discription:</label>
                              <textarea class="form-control" rows="5" id="description" name="description"> {{ $product->description }}</textarea>
                        </div>
                          <button type="submit" class="btn btn-success form-control">Update product</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
