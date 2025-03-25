@extends('admin.layouts.app')

@section('title')
    Colors
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Colors ({{$colors->count()}})</h3>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.colors.create')}}">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <hr>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($colors as $key => $color)
                                    <tr>
                                        <th scope="row">{{$key += 1}}</th>
                                        <td>{{$color->name}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{route('admin.colors.edit',$color)}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="#" onclick="deleteItem({{$color->id}})">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="{{$color->id}}" method="post" action="{{route('admin.colors.destroy',$color->id)}}">
                                                @csrf
                                                @method('DELETE')
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
