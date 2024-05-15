@extends('adminlte::page')
@php $pagename = 'จัดการทีมแพทย์จีน' @endphp
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

    <form method="post" action="{{route('aboutus.update', ['aboutu' => $about->id])}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">รายละเอียด</label>
                            <textarea name="detail" id="detail" class="form-control">{{ $about->detail }}</textarea>
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
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    @section('plugins.Sweetalert2', true)
        @push('js')
        <script type="text/javascript">
            $('#detail').summernote({
                height: 400
            });
        </script>
    @endpush
@endsection
