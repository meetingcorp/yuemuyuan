@extends('adminlte::page')
@php $pagename = 'จัดการผู้ใช้งาน' @endphp
@section('title', setting('title') . ' | ' . $pagename)
@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                            aria-hidden="true"></i> หน้าแรก</a></li>
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
                    <a href="{{ route('users.create') }}" class="btn btn-info mb-4"><i
                            class="fa-solid fa-circle-plus pr-2"></i>เพิ่มข้อมูล</a>
                    <hr>
                    <div class="mt-4">
                        <table id="table"
                            class="table table-sm table-hover table-striped dataTable no-footer dtr-inline text-center nowrap"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>##</th>
                                    <th>ชื่อ</th>
                                    <th>อีเมล</th>
                                    <th>การอนุญาต</th>
                                    <th>การจัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@push('js')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#table').DataTable({
                responsive: true,
                processing: true,
                scrollX: true,
                scrollCollapse: true,
                language: {
                    'url': '{{ asset('json/th.json') }}',
                },
                serverSide: true,
                ajax: "{{ route('users.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'name'
                    },
                    {
                        data: 'email'
                    },
                    {
                        data: 'switches'
                    },
                    {
                        data: 'btn'
                    },
                ],
            });
        });

        function deleteConfirmation(id) {
            Swal.fire({
                icon: 'info',
                title: 'ท่านต้องการลบข้อมูลใช่หรือไม่',
                text: 'หากลบข้อมูลแล้วจะไม่สามารถกู้คืนกลับมาได้',
                showCancelButton: true,
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก',
                showLoaderOnConfirm: true,
                animation: false,
                preConfirm: (e) => {
                    return new Promise(function(resolve) {
                        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            type: 'DELETE',
                            url: "{{ url('admin/users') }}/" + id,
                            data: {
                                _token: CSRF_TOKEN
                            },
                            dataType: 'JSON',
                            success: function(results) {
                                if (results.status === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: results.message,
                                        animation: false,
                                    })
                                    table.ajax.reload();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: results.message,
                                        animation: false,
                                    })
                                }

                            }
                        });
                    })
                },
            })
        }
        function publish(ele) {
            var data = ele.value;
            var frmdata = {
                'data': ele.value
            };
            if (data == 1) {
                ele.value = 0;
            } else {
                ele.value = 1;
            }
            $.ajax({
                type: 'get',
                url: '{{ url('admin/users/publish') }}/' + ele.id,
                data: frmdata,
                success: function(response) {
                    if (response.status === true) {
                        Swal.fire({
                            position: 'top-right',
                            icon: 'success',
                            title: response.message,
                            toast: true,
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    } else {
                        Swal.fire({
                            position: 'top-right',
                            icon: 'error',
                            title: response.message,
                            toast: true,
                            timer: 1000,
                            showCancelButton: false,
                            showConfirmButton: false
                        })
                    }
                }
            })
        }
    </script>
@endpush
@endsection
