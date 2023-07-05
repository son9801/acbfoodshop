@extends('layouts.admin')

@section('content')
    {{-- <div>
        <livewire:admin.revenue.revenue-chart />
        <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
         
    </div> --}}
    <div class="container">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        <div id="app">
            <form action="" method="GET">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label>Từ ngày</label>
                        <input type="date" name="date1" value="{{ Request::get('date1') ?? date('Y-m-d') }}"
                            class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Đến ngày</label>
                        <input type="date" name="date2" value="{{ Request::get('date2') ?? date('Y-m-d') }}"
                            class="form-control">
                    </div>
                    <div class="col-md-6">
                        <br>
                        <button type="submit" class="btn btn-primary text-white">Lọc</button>
                    </div>
                </div>

            </form>
            <div class="flex">
                <div class="w-1/2">
                    {!! $chart->container() !!}
                </div>
            </div>
            <div class="flex">
                <div class="w-1/2">
                    {!! $chart1->container() !!}
                </div>
            </div>

            <h4 class="mt-3">Sản phẩm bán chạy</h4>
            <ol style="list-style-type:decimal;display:flex">
                @forelse ($products as $index => $product)
                <li>
                    <span style="padding: 2px 0px;margin-right: 30px;"> {{ $product->name }}</span>
                </li>
                    {{-- <div style="clear: both;"></div> --}}
                @empty
                    <li>Chưa có sản phẩm được bán</li>
                @endforelse
            </ol>

            {!! $chart->script() !!}
            {!! $chart1->script() !!}
        @endsection
