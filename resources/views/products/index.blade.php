@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Products</div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Edit</th>
                            <th>Delete</th>
                          </tr>
                        </thead>
                        <tbody>
                         @foreach($products as $p)
                          <tr>
                            <td>{{$p->name}}</td>
                            <td>{{$p->price}}</td>
                            <td><a href="{{ route('products.edit', ['id'=>$p->id]) }}" class="btn btn-xs btn-info">Edit</a></td>
                            <td>
                              <form action="{{ route('products.destroy', ['id'=>$p->id]) }}" method="post" enctype="multipart/form-data">

                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <button type="submit" class="btn btn-danger btn-xs"> Delete</button>
                                </form>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
