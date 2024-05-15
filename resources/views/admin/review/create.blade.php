@extends('adminlte::page')
@php $pagename = 'เพิ่มรูปภาพรีวิว' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="contrainer">
        <div class="row pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                                aria-hidden="true"></i> หน้าแรก</a></li>
                    <li class="breadcrumb-item"><a href="#" onclick="history.back()"
                            class="text-info">จัดการรูปภาพรีวิว</a></li>
                    <li class="breadcrumb-item active">{{ $pagename }}</li>
                </ol>
            </nav>
        </div>

        <div class="card card-outline card-info">
            <div class="card-body">
                <h3>{{ $pagename }}</h3>
            </div>
        </div>

        <form method="post" action="{{ route('review.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group" style="max-width: 50%;">
                                <label for="title">รูปภาพรีวิว</label>
                                <input name="title" type="text" class="form-control" required>
                                <div class="mt-4">
                                    <label for="img">รูปภาพ</label><br>
                                    <img src="{{ asset('images/no-image.jpg') }}" height="200" id="showimg"><br>
                                    <span class="text-danger">**รูปภาพขนาด 800x800 pixel**</span>
                                    <div class="input-group mt-1">
                                        <input name="imgs" type="file" class="custom-file-input" id="imgInp">
                                        <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <a class="btn btn-secondary" onclick="history.back();"><i
                                        class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                <button class="btn btn-info" id="btnsubmit"><i class="fas fa-save mr-2"></i>บันทึก</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    @push('js')
        <script>
            imgInp.onchange = evt => {
                const [file] = imgInp.files;
                if (file) {
                    validateupload('imgInp');
                    showimg.src = URL.createObjectURL(file);
                }
            }
            function validateupload(id) {
                let dataimg = document.getElementById(id);
                let FileUploadPath = dataimg.value;
                let Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
                // console.log(Extension);
                if (Extension == "gif" || Extension == "png" || Extension == "jpeg" || Extension == "jpg") {
                    $('#btnsubmit').prop('disabled', false);
                } else {
                    $('#btnsubmit').prop('disabled', true);
                }
            }
        </script>
    @endpush
@endsection