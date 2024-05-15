@extends('adminlte::page')
@php $pagename = 'แก้ไขสิทธิ์ผู้ใช้งาน' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                            aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="{{ route('role.index') }}" class="text-info">จัดการสิทธิ์การใช้งาน</a>
                </li>
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
                        {{--                        @php dd($roles->getPermissionNames()) @endphp --}}
                        <form method="post" action="{{ route('role.update', ['role' => $roles->id]) }}">
                            @method('PUT')
                            @csrf
                            <label for="name">ชื่อสิทธิ์</label>
                            <input name="name" type="text" class="form-control" value="{{ $roles->name }}" required>
                            <label for="permiss">สิทธิ์การเข้าถึง</label>
                            <select class="permissmulti form-control" name="permiss[]" multiple="multiple">
                                @foreach ($permiss as $item)
                                    <option value="{{ $item->id }}" @if (in_array($item->name, $roles->getPermissionNames()->toArray())) selected @endif>
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                            <div class="mt-2">
                                <button class="btn btn-info">บันทึก</button>&nbsp;
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
            $('.permissmulti').select2();
        });
    </script>
@endpush
@endsection
