@extends('adminlte::page')
@php $pagename = 'เพิ่มหมวดหมู่สินค้า' @endphp
@section('title' ,setting('title').' | '.$pagename)

@section('content')

{{-- <div class="row pt-4">
    <div class="col-12">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="m-auto">{{$page}}</h3>
            </div>
            <div class="card-title">
                <ol class="breadcrumb bg-white m-auto">
                    <li class="breadcrumb-item"><a href="{{url('admin')}}"><i class="fa fa-home fa-fw" aria-hidden="true"></i>หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="history.back()">จัดการหมวดหมู่สินค้า</a></li>
                    <li class="breadcrumb-item active">{{$pagename}}</li>
                </ol>
            </div>
        </div>
    </div>
</div> --}}
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()">จัดการหมวดหมู่สินค้า</a></li>
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
            <div class="col-md-8">
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
                                <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                                    @csrf
                                    <label for="title">หมวดหมู่</label><br/>
                                    <input name="title" type="text" class="form-control" required><br/>
                                    <label for="img">รูปภาพ</label><br>
									<span class="text-danger">**รูปภาพขนาด 300x300 pixel**</span>
                                    <div class="input-group mt-1">
                                        <input name="imgs" type="file" class="custom-file-input" id="imgInp">
                                        <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                    </div>
                                    <br/>
                                    <div class="float-right">
                                        <a class="btn btn-secondary" onclick="history.back();"><i
                                                class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                        <button class="btn btn-info" id="btnsubmit"><i class="fas fa-save mr-2"></i>บันทึก</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-outline card-cyan">
                    <div class="card-header">
                        <b>แสดงรูปภาพ</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                        <div class="card-body text-center">
                            <div>
                                <img class="card-img" src="{{asset('images/no-image.jpg')}}" id="showimg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files
                if (file) {
                    showimg.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endpush
@endsection
