@extends('adminlte::page')
@php $pagename = 'แก้ไข Permission' @endphp
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
                        <form method="post" action="{{ route('permission.update', ['permission' => $permiss->id]) }}">
                            @method('PUT')
                            @csrf
                            <label for="name">permission</label>
                            <input name="name" type="text" class="form-control" value="{{ $permiss->name }}" required>
                            <div class="mt-2">
                                <button class="btn btn-info">{{__('admin.update')}}</button>&nbsp;
                                <a class="btn btn-secondary" onclick="history.back();">{{ __('admin.cancel') }}</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('plugins.Select2', true)
@push('js')
@endpush
@endsection
