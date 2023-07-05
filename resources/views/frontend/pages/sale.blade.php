@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('content')
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4 class="mb-4">Sản phẩm khuyến mãi</h4>
                </div>
                <livewire:frontend.product.sale />
            </div>
        </div>
    </div>
@endsection