@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="py-3 pyt-md-4">
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            @if (session('message'))
                <h5 class="alert alert-success">{{ session('message') }}</h5>
            @endif
            <div class="p-4 shadow bg-white">
                <h2>ABC SHOP</h2>
                <h4>Cảm ơn bạn đã mua hàng tại ACB food</h4>
                <a href="{{ url('collections') }}" class="btn btn-primary">Tiếp tục mua hàng</a>
            </div>
        </div>
    </div>
</div>
    </div>
@endsection
