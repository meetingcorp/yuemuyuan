@extends('adminlte::page')
@php $pagename = 'เพิ่ม Service' @endphp
@section('title' ,setting('title').' | '. $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการ Service</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form method="post" action="{{route('service.store')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">

                            <label for="title">หัวข้อ</label>
                            <input name="title" type="text" class="form-control" required>
                            <label for="shortdetail">รายละเอียดย่อย</label><br>
                            <textarea class="form-control" name="shortdetail" id="shortdetail" cols="30" rows="3"></textarea>
                            <label for="title">รายละเอียด</label>
                            <textarea name="detail" id="detail" class="form-control"></textarea>
                            <div class="mt-4">
                                <label for="img">รูปภาพ</label><br>
                            <img src="{{asset('images/no-image.jpg')}}" style="max-height: 200px; width: auto;" id="showimg"><br>
                            <span class="text-danger">**รูปภาพขนาด 1080x1080 pixel**</span>
                            <div class="input-group mt-1">
                                <input name="imgs" type="file" class="custom-file-input" id="imgInp">
                                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
                            </div>
                            </div>

                        </div>

                        <div class="float-right">
                            <a class='btn btn-secondary' onclick='history.back();'><i
                                class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </form>

        @push('js')
        <script type="text/javascript">
            $('#detail').summernote({
                height: 400
            });
        </script>
    @endpush
@endsection