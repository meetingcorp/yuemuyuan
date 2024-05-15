@extends('adminlte::page')
@php $pagename = 'แก้ไขผู้ใช้งาน' @endphp
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
    <form method="post" action="{{ route('users.update', ['user' => $detail->id]) }}" onSubmit="return checkpass()" id="frmupdate" name="frmuser">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">ชื่อผู้ใช้งาน</label>
                            <input type="text" name="name" class="form-control" value="{{ $detail->name }}" required>
                            <label class="mt-4" for="username">username</label>
                            @error('username')
                                <span class="text-danger">** {{ $message }}</span>
                            @enderror
                            <input class="form-control" type="text" name="username" value="{{ $detail->username }}"
                                required>
                            <label class="mt-4" for="email">อีเมล</label>
                            <input type="email" name="email" class="form-control" placeholder="example@meeting.com"
                                value="{{ $detail->email }}" required>
                            <label class="mt-4" for="userrole">สิทธิ์ผู้ใช้งาน</label>
                            <select name="userrole" id="userrole" class="form-control">
                                @foreach ($roles as $rol)
                                    @if (Auth::user()->hasRole('supreme administrator'))
                                        @if ($rol->id == $detail->role_id)
                                            <option value="{{ $rol->name }}" selected>{{ $rol->name }}</option>
                                        @else
                                            <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                        @endif
                                    @else
                                        @if ($rol->name == 'supreme administrator')
                                        @else
                                            @if ($rol->id == $detail->role_id)
                                                <option value="{{ $rol->name }}" selected>{{ $rol->name }}</option>
                                            @else
                                                <option value="{{ $rol->name }}">{{ $rol->name }}</option>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                            <label class="mt-4" for="password">รหัสผ่าน</label>
                            <input type="password" name="password" class="form-control" minlength="6">
                            <label class="mt-4" for="comfirmpass">ยืนยันรหัสผ่าน</label>
                            <input type="password" name="comfirmpass" class="form-control" minlength="6">
                        </div>

                        <div class="float-right mt-4">
                            <a class='btn btn-secondary' onclick='history.back();'><i
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
        function checkpass() {
            var pass1 = document.forms['frmuser']['password'].value;
            var pass2 = document.forms['frmuser']['comfirmpass'].value;
            // alert(pass1 == pass2);
            if (pass1 === pass2) {
                return true;
            }
            Swal.fire({
                icon: 'error',
                title: 'ผิดพลาด',
                text: 'รหัสผ่านไม่ถูกต้อง',
                animation: false,
            });
            document.forms['frmuser']['password'].focus();
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
