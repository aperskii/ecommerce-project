@extends('admin.layouts.app')

@section('title')
    Coupons
@endsection

@section('content')
    <div class="row">
        @include('admin.layouts.sidebar')
        <div class="col-md-9">
            <div class="row mt-2">
                <div class="col-md-12">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <h3 class="mt-2">Coupons ({{$coupons->count()}})</h3>
                        <a class="btn btn-sm btn-primary" href="{{route('admin.coupons.create')}}">
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
                                <th scope="col">Discount</th>
                                <th scope="col">Validity</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($coupons as $key => $coupon)
                                    <tr>
                                        <th scope="row">{{$key += 1}}</th>
                                        <td>{{$coupon->name}}</td>
                                        <td>{{$coupon->discount}}</td>
                                        <td>
                                            @if ($coupon->checkIfValid())
                                                <span class="bg-success border border-dark p-1 text-white">
                                                    Valid until {{\Carbon\Carbon::parse($coupon->valid_until)->diffForHumans()}}
                                                </span>
                                            @else
                                                <span class="bg-danger border border-dark p-1 text-white">
                                                    Expired
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-warning" href="{{route('admin.coupons.edit',$coupon)}}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a class="btn btn-sm btn-danger" href="#" onclick="deleteItem({{$coupon->id}})">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                            <form id="{{$coupon->id}}" method="post" action="{{route('admin.coupons.destroy',$coupon->id)}}">
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
