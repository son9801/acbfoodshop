@extends('layouts.app')

@section('title', 'Thực phẩm xanh ACB')
@section('content')
    <div class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Mặt hàng mới</h4>
                    <div class="underline"></div>
                </div>
                <livewire:frontend.pages.new-arrivals  />
            
            </div>
        </div>
    </div>
@endsection
