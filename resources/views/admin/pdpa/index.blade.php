@extends('adminlte::page')
@php $pagename = 'จัดการ PDPA' @endphp
@section('title', setting('title') . ' | ' . $pagename)
@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
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
                    <a href="{{ route('pdpa.create') }}" class="btn btn-info mb-4"><i class="fa-solid fa-circle-plus pr-2"></i>เพิ่มข้อมูล</a>
                    <hr>
                    <div class="mt-4">
                        <table id="table" class="table table-sm table-hover table-striped dataTable no-footer dtr-inline text-center nowrap"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">##</th>
                                    <th>หัวข้อ</th>
                                    {{-- <th>Cookie</th> --}}
                                    <th style="width: 7%;">เลือก</th>
                                    <th style="width: 15%;">การจัดการ</th>
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
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@push('js')
    <script>
        var table;
        $(document).ready(function() {
            table = $('#table').DataTable({
                responsive: true,
                processing: true,
                scrollX: true,
                scrollCollapse: true,
                autoWidth: true,
                language: {
                    'url' : '{{ asset('json/th.json') }}',
                },
                serverSide: true,
                ajax: "{{ route('pdpa.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'id'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'selection'
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
                            url: "{{ url('admin/pdpa') }}/" + id,
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
            $.ajax({
                type: 'get',
                url: '{{ url('admin/pdpa/publish') }}/' + ele.id,
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
