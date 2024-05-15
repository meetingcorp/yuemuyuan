@extends('adminlte::page')
@php $pagename = 'เพิ่มหมวดหมู่ย่อย' @endphp
@section('title' ,setting('title').' | '.$pagename)

@section('content')

    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()">จัดการหมวดหมู่ย่อย</a></li>
                    <li class="breadcrumb-item active">{{$pagename}}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-cyan">
                    <div class="card-header">
                        {{-- <b>เพิ่มหมวดหมู่</b> --}}
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="form-group">
                                <form method="post" action="{{route('sub.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <label for="title">ชื่อหมวดหมู่ย่อย</label><br/>
                                    <input name="title" type="text" class="form-control" required><br/>
                                    <label for="maincategory">หมวดหมู่หลัก</label>
                                    <select name="maincategory" id="maincategory" class="form-control" required>
                                        @foreach ($maincategory as $item) 
                                            <option value="{{$item->id}}">{{$item->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="float-right mt-2">
                                        <a class="btn btn-secondary" onclick="history.back();"><i
                                                class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                        <button class="btn btn-info" id="btnsubmit"><i class="fas fa-save mr-2"></i>บันทึก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @section('plugins.Select2', true)
    @push('js')
        <script>
            $(document).ready(function() {
                $('#maincategory').select2();
            });
        </script>
    @endpush
@endsection
