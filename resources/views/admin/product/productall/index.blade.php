@extends('adminlte::page')
@php $pagename = 'จัดการสินค้าทั้งหมด' @endphp
@section('title', setting('title').' | '.$pagename)
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
                    <a href="{{route('product.create')}}" class="btn btn-info mb-4"><i class="fa-solid fa-circle-plus pr-2"></i>เพิ่มข้อมูล</i></a>
                    <hr>
                    <div class="mt-4">
                        {{-- <div class="form-group mb-4" style="width: 10%;">
                            <label for="cate">ค้นหาตามหมวดหมู่</label>
                            <select name="cate" id="cate" class="form-control">
                                <option value="all">ทั้งหมด</option>
                                @foreach($cate as $item)
                                    <option value="{{$item->slug}}">{{$item->title}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <table id="table" class="table table-striped dataTable no-footer dtr-inline text-center nowrap" style="width: 100%;">
                            <thead>
                            <tr>
                                <td>##</td>
                                <td>หัวเรื่อง</td>
                                 <td>รูปภาพ</td>
                                <td>การมองเห็น</td>
                                <td width="10%">ลำดับ</td>
                                <td>การจัดการ</td>
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
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('plugins.Sweetalert2', true)
@section('plugins.Datatables', true)
@push('js')
    <script>
        var table;
        $(document).ready( function () {
            table = $('#table').DataTable({
                responsive: true,
                processing: true,
                scrollX: true,
                scrollCollapse: true,
                autoWidth: true,
                language: {
                    url: "{{ asset('json/th.json') }}",
                },
                serverSide: true,
                ajax: "{{route('product.index')}}",
                columns: [
                    {data: 'DT_RowIndex', name: 'id'} ,
                    {data: 'title'},
                    {data: 'img'},
                    {data: 'switches'},
                    {data: 'sorting'},
                    {data: 'btn'},
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
                        return new Promise(function (resolve) {
                            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                            $.ajax({
                                type: 'DELETE',
                                url: "{{url('admin/product')}}/" + id,
                                data: {_token: CSRF_TOKEN},
                                dataType: 'JSON',
                                success: function (results) {
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

        function publish(ele){
                var data = ele.value;
                var frmdata = {
                    'data': ele.value
                };
                if(data == 1){
                    ele.value = 0;
                }else{
                    ele.value = 1;
                }

                $.ajax({
                    type: 'get',
                    url: '{{url('admin/product/publish')}}/'+ele.id,
                    data: frmdata,
                    success: function (response){
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

            function sort(ele){
                var frmdata = {
                    'data': ele.value
                };
                $.ajax({
                    type: 'get',
                    url: '{{url('admin/product/sort')}}/'+ele.id,
                    data: frmdata,
                    success: function (response){
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

            $('#cate').on('change', ()=>{
                let caltegory = $('#cate').val();
                let lin = '';
                if(caltegory == 'all'){
                    lin = "{{route('product.index')}}";
                }else{
                    lin = "{{url('admin/product/getdata')}}/"+caltegory;
                }
                table.clear();
                table.destroy();
                table = $('#table').DataTable({
                    responsive: true,
                    processing: true,
                    scrollX: true,
                    scrollCollapse: true,
                    autoWidth: true,
                    language: {
                        url: "{{ asset('json/th.json') }}",
                    },
                    serverSide: true,
                    ajax: lin,
                    columns: [
                        {data: 'DT_RowIndex', name: 'id'} ,
                        {data: 'title'},
                        {data: 'img'},
                        {data: 'switches'},
                        {data: 'sorting'},
                        {data: 'btn'},
                    ],
                });
            });
    </script>
@endpush
@endsection
