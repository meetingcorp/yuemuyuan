@extends('adminlte::page')
@php $pagename = 'เพิ่มข้อมูล' @endphp
@section('title', setting('title') . ' | ' . $pagename)
@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="card card-outline card-info card-tabs">
                        <form method="post" action="{{ route('pdpa.store') }}" enctype="multipart/form-data" id="frmstore">
                            @csrf
                            <div class="card-header p-0 pt-1">
                                <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                            href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings"
                                            aria-selected="false">หัวเรื่อง</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-home-tab" data-toggle="pill"
                                            href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                            aria-selected="true">Cookie</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                            href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
                                            aria-selected="false">Policy</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-two-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-two-settings" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-settings-tab">
                                        <input class="form-control" type="text" name="title" id="title">
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-home" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-home-tab">
                                        @include('admin.pdpa.partials.create.cookies')
                                    </div>
                                    <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                        aria-labelledby="custom-tabs-two-profile-tab">
                                        @include('admin.pdpa.partials.create.policy')
        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <div class="mt-auto">
                                    <a href="{{route('pdpa.index')}}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-2"></i>ย้อนกลับ
                                    </a>
                                    <button class="btn btn-info"><i
                                            class="fas fa-save mr-2"></i>บันทึก</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@section('plugins.Sweetalert2', true)
@endsection
