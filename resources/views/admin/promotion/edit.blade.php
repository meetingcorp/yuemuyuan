@extends('adminlte::page')
@php $pagename = 'แก้ไข Promotion' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการ Promotion</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>
    <form method="post" action="{{ route('promotion.update', ['promotion' => $data->id]) }}"
        enctype="multipart/form-data" id="frmupdate">
        @method('PUT')
        @csrf
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">หัวข้อ</label>
                            <input name="title" type="text" class="form-control" value="{{ $data->title }}" required>
                            <label for="shortdetail">รายละเอียดย่อย</label><br>
                            <textarea class="form-control" name="shortdetail" id="shortdetail" cols="30" rows="3">{{ $data->short_detail }}</textarea>
                            <label for="title">รายละเอียด</label>
                            <textarea name="detail" id="detail" class="form-control">{!! $data->detail !!}</textarea>
                            <div class="mt-4">
                                <label for="img">รูปภาพ</label><br>
                                <img src="@if ($data->getFirstMediaUrl('promotion')) {{ $data->getFirstMediaUrl('promotion') }}
                                @else{{ asset('images/no-image.jpg') }} @endif"
                                    style="max-height: 200px; width: auto;" id="showimg"><br>
                                <span class="text-danger">**รูปภาพขนาด 1080x1920 pixel**</span>
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
            tinymce.init({
                selector: '#detail',
                plugins: 'responsivefilemanager print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
                menubar: 'file edit view insert format tools table help',
                toolbar: 'image | responsivefilemanager | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                height: 400,
                relative_urls: false,
                remove_script_host: false,
                convert_urls: true,
                external_filemanager_path: "{{ asset('vendor/responsive_filemanager/filemanager') }}/",
                filemanager_title: "File manger",
                external_plugins: {
                    "responsivefilemanager": "{{ asset('vendor/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                    "filemanager": "{{ asset('vendor/responsive_filemanager/filemanager/plugin.min.js') }}"
                },
            })
        </script>
    @endpush
@endsection
