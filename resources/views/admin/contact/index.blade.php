@extends('adminlte::page')
@php $pagename = 'กล่องข้อความ' @endphp
@section('title', setting('title') . ' | ' . $pagename)
@section('content')
<style>
	[class*=sidebar-dark] .brand-link, [class*=sidebar-dark] .brand-link .pushmenu {
	font-size:12px !important;
	}
</style>
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
                    <div class="mt-4">
                        <table id="table"
                            class="table table-sm table-hover table-striped dataTable no-footer dtr-inline text-center nowrap"
                            style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">##</th>
                                    <th>ชื่อ</th>
                                    <th style="width: 25%;">อีเมล</th>
                                    <th style="width: 25%;">วันที่</th>
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
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="contentbody">
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
                order: [3, 'desc'],
                columnDefs: [{targets: 4, orderable: false}
                ],
                language: {
                    'url': '{{ asset('json/th.json') }}',
                },
                serverSide: true,
                ajax: "{{ route('contact.index') }}",
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
                        data: 'createdate'
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
                            url: "{{ url('admin/contact') }}/" + id,
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

        async function readapi(id) {
            // let id = id;
            await $.ajax({
                type: 'GET',
                url: "{{ url('admin/contact') }}/" + id,
                success: function(response) {
                    var data = JSON.parse(response.data);
                    // console.log(response);
                    document.getElementById("exampleModalLongTitle").textContent = response.name;
                    document.getElementById("contentbody").innerHTML = "<p>ชื่อ: " + (response.name ?
                            response.name : ' ') + "</p>" +
                        "<p>อีเมล: " + (data.email ? data.email : ' ') + "</p>" +
                        "<p>เรื่อง: " + (data.subject ? data.subject : ' ') + "</p>" +
                        "<p>เบอร์โทรศัพท์: " + (data.remark ? data.tel : ' ') + "</p>" +
                        "<p>หมายเหตุ: " + (data.remark ? data.remark : ' ') + "</p>" +
                        // "<p>สายการบิน: "+ (JSON.parse(response.data).airport ? JSON.parse(response.data).airport : ' ' ) +"</p>"+
                        // "<p>ข้อความ: "+ (JSON.parse(response.data).message ? JSON.parse(response.data).message : ' ' ) +"</p>"+
                        "<p>เรื่อง: " + (response.title ? response.title : ' ') + "</p>";
                }
            });
        }
    </script>
@endpush
@endsection
