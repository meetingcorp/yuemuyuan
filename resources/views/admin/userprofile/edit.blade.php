@extends('adminlte::page')
@php $pagename = 'แก้ไขโปรไฟล์' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการผู้ใช้งาน</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>
    <form action="{{ route('profile.update', ['profile' => Auth::user()->id]) }}" id="frmupdate"
        method="post" onsubmit="return comfirmdata();">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">

                                <label>ชื่อ-นามสกุล</label>
                                <input class="form-control" type="text" name="name" value="{{ Auth::user()->name }}">
                                <label class="mt-4">username</label>
                                <input class="form-control" type="text" name="username" value="{{ Auth::user()->username }}">
                                <label class="mt-4">email</label>
                                <input class="form-control" type="email" name="mail" value="{{ Auth::user()->email }}">
                                <label class="mt-4">รหัสผ่าน</label>
                                <input class="form-control" type="password" name="pass" id="pass">
                                <label class="mt-4">ยืนยันรหัสผ่าน</label>
                                <input class="form-control" type="password" name="passconfirm" id="passconfirm">
                        </div>

                        <div class="float-right mt-4">
                            <a class='btn btn-secondary' onclick='window.history.back();'><i
                                    class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                            <button class='btn btn-info'><i class="fas fa-save mr-2"></i>บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@section('plugins.Sweetalert2', true)
@push('js')
    <script>
        function comfirmdata() {
            let pass = $('#pass').val();
            let cpass = $('#passconfirm').val();

            if (pass === cpass) {
                return true;
            }
            Swal.fire({
                title: 'รหัสผ่านไม่ตรงกัน',
                icon: 'warning',
            })
            return false;
        }

        function confirmupdate() {
            Swal.fire({
                icon: 'info',
                title: 'ท่านต้องการบันทึกข้อมูลหรือไม่ !!',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
            }).then((results) => {
                if (results.isConfirmed) {
                    frmupdate.submit();
                } else {

                }
            });
        }
    </script>
@endpush
@endsection
