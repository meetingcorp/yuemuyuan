@extends('adminlte::page')
@php $pagename = 'เพิ่มสิทธิ์ผู้ใช้งาน' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                            aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ route('role.index') }}" class="text-info">จัดการสิทธิ์การใช้งาน</a></li>
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
                    <div class="form-group" style="max-width: 60%;">
                        <form method="post" action="{{ route('role.store') }}">
                            @csrf
                            <label for="name">ชื่อสิทธิ์</label>
                            <input name="name" type="text" class="form-control" required>
                            <label for="">การเข้าถึง</label>
                            <select class="js-example-basic-multiple form-control" name="permiss[]" multiple="multiple">
                                @foreach ($permissions as $permiss)
                                    <option value="{{ $permiss->name }}">{{ $permiss->name }}</option>
                                @endforeach
                            </select><br>
                            <div class="mt-2">
                                <button class="btn btn-info">เพิ่มข้อมูล</button>&nbsp;
                                <a class="btn btn-secondary" onclick="history.back();">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('plugins.Select2', true)
@push('js')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });
    </script>
@endpush
@endsection
