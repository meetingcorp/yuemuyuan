@extends('adminlte::page')
@php $pagename = 'แก้ไขข้อมูลโครงการ' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw" aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการโปรเจค</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>

    <form method="post" action="{{ route('project.update', ['project' => $data->id]) }}"
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
                            <label for="detail" class="mt-4">รายละเอียด</label><br>
                            <textarea name="detail" id="detail">{{ $data->detail }}</textarea><br>
                            <label for="img">รูปภาพ</label><br>
                            <div class="dropzone image-preview " id="imageDropzone">
                                <div class="dz-message">
                                    <i class="fas fa-upload"></i><br>
                                    <span>อัพโหลดรูปภาพของคุณ!</span>
                                </div>
                            </div>
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

@section('plugins.Sweetalert2', true)
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous"></script>
    <script>
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
            height: 350,
            relative_urls: false,
            remove_script_host: false,
            convert_urls: true,
            external_filemanager_path: "{{ asset('vendor/responsive_filemanager/filemanager') }}/",
            filemanager_title: "File manger",
            external_plugins: {
                "responsivefilemanager": "{{ asset('vendor/responsive_filemanager/tinymce/plugins/responsivefilemanager/plugin.min.js') }}",
                "filemanager": "{{ asset('vendor/responsive_filemanager/filemanager/plugin.min.js') }}"
            },
        });

        Dropzone.prototype.defaultOptions.dictRemoveFile =
            "<i class=\"fa fa-trash ml-auto mt-2 fa-1x text-danger\"></i> ลบรูปภาพ";
        Dropzone.autoDiscover = false;
        var uploadedImageMap = {}
        $('#imageDropzone').dropzone({
            url: "{{ route('uploadimg') }}",
            // maxFilesize: 2, // MB
            addRemoveLinks: true,
            dictCancelUpload: 'ยกเลิกอัพโหลด',
            acceptedFiles: 'image/*',
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {
                $(file.previewElement).append('<input type="hidden" name="image[]" value="' + response.name +
                    '">')
                uploadedImageMap[file.name] = response.name
            },
            init: function() {

                @if ($images)
                    @foreach ($images as $key => $image)
                        var file = {!! json_encode($image) !!};
                        file.url = '{!! $image->getUrl() !!}';
                        file.name = '{!! $image->file_name !!}';
                        this.options.addedfile.call(this, file)
                        this.options.thumbnail.call(this, file, file.url);
                        file.previewElement.classList.add('dz-complete')
                        $(file.previewElement).append('<input type="hidden" name="image[]" value="' + file
                            .file_name + '">')
                    @endforeach
                @endif
                this.on('removedfile', (file) => {
                        let data = {
                            '_token': '{{ csrf_token() }}',
                            'name': file.name,
                        }

                        $.ajax({
                            type: 'post',
                            url: "{{route('delimg')}}",
                            data: data,
                            success: (response) => {

                            }
                        });
                    });
            }
        })
        $(function() {
            $("#imageDropzone").sortable({
                items: '.dz-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: '#imageDropzone',
                distance: 20,
                tolerance: 'pointer'
            });
        });
        //!------------------------------

        $("input").keypress(function(e) {
            if (e.which == 13) {
                return false;
            }
        });

        $("#checkAll").click(function() {
            $(".treeview").hummingbird("checkAll");
        });
        $("#uncheckAll").click(function() {
            $(".treeview").hummingbird("uncheckAll");
        });

        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#treeview li").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    </script>
@endpush
@endsection
