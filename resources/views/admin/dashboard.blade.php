@extends('adminlte::page')
@php $pagename = 'หน้าแรก' @endphp
@section('title', setting('title').' | '.$pagename)
@section('content')
@section('content')

    <div class="row" style="padding-top: 20px;">
        <div class="col-12">
            <div class="card card-outline card-info">
                <div class="card-body">
                    <h3>{{ $pagename }}</h3>
                </div>
            </div>
        </div>
	{{-- 
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ผู้เข้าชม</span>
                    <span class="info-box-number">
                    {{$analyticsData['ga:visitors']}}
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-eye"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">จำนวนหน้าที่ชม</span>
                    <span class="info-box-number">
                    {{$analyticsData['ga:pageviews']}}
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-user"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">ผู้เข้าชมใหม่</span>
                    <span class="info-box-number">
                  {{$analyticsData['ga:newUsers']}}
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-desktop"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Bounce Rate</span>
                    <span class="info-box-number">
                    {{number_format($analyticsData['ga:bounceRate'],2) }}
                  <small>%</small>
                </span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
                            <div class="container">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
                            <div class="text-center pb-2">
                                <b>หน้าเพจที่เข้าบ่อยสุด</b>
                            </div>

                            <table class="table table-sm table-bordered" id="the_most_page_views">
                                <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>URL</th>
                                    <th>TOTAL</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i=1 @endphp
                                @foreach($mostpages as $page)

                                    <tr>
                                        <td>
                                            {{$i}}
                                        </td>
                                        <td>
                                            {{$page['url']}}
                                        </td>
                                        <td>
                                            {{$page['pageViews']}}
                                        </td>
                                    </tr>
                                    @php $i++ @endphp
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
    @section('plugins.Chartjs',true)
    @push('js')
        <script>
         
        </script>
    @endpush
@endsection
