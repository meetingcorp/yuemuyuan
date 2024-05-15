@extends('adminlte::page')
@php $page = 'แก้ไขหมวดหมู่สินค้า' @endphp
@section('title', setting('title') . ' | ' . $page)
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endpush

@section('content')
    <div class="row pt-4">
        <div class="col-12">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="m-auto">{{ $page }}</h3>
                </div>
                <div class="card-title">
                    <ol class="breadcrumb bg-white m-auto">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}"><i class="fa fa-home fa-fw"
                                    aria-hidden="true"></i>หน้าแรก</a></li>
                        <li class="breadcrumb-item"><a href="#" onclick="history.back()">จัดการหมวดหมู่สินค้า</a></li>
                        <li class="breadcrumb-item active">{{ $page }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-outline card-cyan">
                    <div class="card-header">
                        <b>แก้ไขหมวดหมู่</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <form method="post" action="{{ route('category.update', ['category' => $category->id]) }}"
                                enctype="multipart/form-data" id="frmupdate">
                                @method('PUT')
                                @csrf
                                <label for="title">หมวดหมู่</label><br />
                                <input name="title" type="text" class="form-control" value="{{ $category->title }}"
                                    required>
                                <br />
                                <label for="img">รูปภาพ</label><br>
                                <span class="text-danger">**รูปภาพขนาด 300x300 pixel**</span>
                                <div class="input-group mt-1">
                                    <input name="imgs" type="file" class="custom-file-input" id="imgInp">
                                    <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                </div>
                                <br />
                            </form>
                            <div class="float-right">
                                <a class="btn btn-secondary" onclick="history.back();"><i
                                        class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                <button class="btn btn-info" id="btnsubmit" onclick="confirmupdate()"><i class="fas fa-save mr-2"></i>บันทึก</button>
                            </div>
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
                            <img class="card-img"
                                src="@if ($category->getFirstMediaUrl('productcategory')) {{ asset($category->getFirstMediaUrl('productcategory')) }}
                                    @else{{ asset('images/no-image.jpg') }} @endif"
                                id="showimg">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('plugins.Sweetalert2', true)
@push('js')
    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                showimg.src = URL.createObjectURL(file)
            }
        }

        function confirmupdate() {
            Swal.fire({
                title: 'ท่านต้องการบันทึกข้อมูลหรือไม่ !!',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'บันทึก',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
            }).then((results) => {
                if (results.isConfirmed) {
                    frmupdate.submit();
                }
            });
        }
    </script>
@endpush
@endsection
