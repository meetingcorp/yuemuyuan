@extends('adminlte::page')
@php $pagename = 'เพิ่มสินค้า' @endphp
@section('title', setting('title') . ' | ' . $pagename)

@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                            aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()" class="text-info">จัดการสินค้า</a></li>
                <li class="breadcrumb-item active">{{ $pagename }}</li>
            </ol>
        </nav>
    </div>

    <div class="card card-outline card-info">
        <div class="card-body">
            <h3>{{ $pagename }}</h3>
        </div>
    </div>
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-cyan">
                    {{-- <div class="card-header">
                        <b>เพิ่มสินค้า</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div> --}}
                    {{-- <div class="card-body"> --}}
                        <div class="form-group">
                            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header p-0 pt-1">
                                    <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                        {{-- <li class="pt-2 px-3">
                                            <h3 class="card-title">Card Title</h3>
                                        </li> --}}
                                        <li class="nav-item">
                                            <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                                href="#custom-tabs-two-home" role="tab"
                                                aria-controls="custom-tabs-two-home" aria-selected="true">หัวข้อ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                                href="#custom-tabs-two-profile" role="tab"
                                                aria-controls="custom-tabs-two-profile" aria-selected="false">รายละเอียด & รายละเอียดย่อย</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                                href="#custom-tabs-two-messages" role="tab"
                                                aria-controls="custom-tabs-two-messages" aria-selected="false">รูปภาพ & SEO</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content" id="custom-tabs-two-tabContent">
                                        <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                            aria-labelledby="custom-tabs-two-home-tab">
                                            <label for="title">ชื่อสินค้า</label>
                                            <input name="title" type="text" class="form-control" required>
                                            <label for="categorys">หมวดหมู่</label>
                                            <select name="categorys" class="js-example-basic-multiple form-control">
                                                @foreach ($cate as $item)
                                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            <label for="price">ราคา</label>
                                            <input name="price" type="number" class="form-control" required>
                                            <label>ราคาพิเศษ</label>
                                            <input type="number" name="spacialprice" class="form-control">
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                            aria-labelledby="custom-tabs-two-profile-tab">
                                            <label for="shortdetail">เนื้อหาย่อ</label><br>
                                            <textarea class="form-control" name="shortdetail" id="shortdetail" cols="30" rows="3"></textarea>
                                            <br>
                                            <label for="detail">รายละเอียด</label><br>
                                            <textarea class="form-control" name="detail" id="detail" cols="30" rows="10"></textarea><br>
                                            @include('admin.product.productall.partials.create.subdetail')
                                        </div>
                                        <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                            aria-labelledby="custom-tabs-two-messages-tab">
                                            <label for="img">รูปภาพ</label><br>
                                            <span class="text-danger">**รูปภาพขนาด 300x300 pixel**</span>
                                            <div class="dropzone image-preview " id="imageDropzone">
                                                <div class="dz-message">
                                                    <i class="fas fa-upload"></i><br>
                                                    <span>อัพโหลดรูปภาพของคุณ!</span>
                                                </div>
                                            </div>
                                            <label>SEO Keyword</label>
                                            <input class="form-control" type="text" name="metatag">
                                            <label>SEO Description</label>
                                            <input class="form-control" type="text" name="metadesc">
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right mt-2">
                                    <a class="btn btn-secondary" onclick="history.back();"><i
                                            class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                    <button class="btn btn-info" id="btnsubmit"><i
                                            class="fas fa-save mr-2"></i>บันทึก</button>
                                </div>
                            </form>
                        </div>
                    {{-- </div> --}}
                </div>
            </div>
        </div>
    </div>
@section('plugins.Select2', true)
@push('js')
    {{-- script เอาไว้ sort รูปภาพ --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous"></script>
    <script>

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
        });

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
        });

        Dropzone.prototype.defaultOptions.dictRemoveFile =
            "<i class=\"fa fa-trash ml-auto mt-2 fa-1x text-danger\"></i> ลบรูปภาพ";
        Dropzone.autoDiscover = false;
        var uploadedImageMap = {}
        $('#imageDropzone').dropzone({
            url: "{{ route('dropzone.upload') }}",
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
                this.on('removedfile', (file) => {
                    let data = {
                        '_token': '{{ csrf_token() }}',
                        'name': file.name,
                    }

                    $.ajax({
                        type: 'post',
                        url: "{{ route('dropzone.delete') }}",
                        data: data,
                        success: (response) => {

                        }
                    });
                });
            }
        });
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

        // function createsubele(){
        //     let ele = document.getElementById('subelement');
        //     let titles = document.createElement("input");
        //     titles.setAttribute("name", "subtitle[]");
        //     titles.setAttribute("class", "form-control");

        //     let details = document.createElement('textarea');
        //     details.setAttribute("row", "3");
        //     details.setAttribute("class", "form-control");
        //     details.setAttribute("name", "subdetail[]");

        //     ele.appendChild(titles);
        //     ele.appendChild(details);

        // }
    </script>
@endpush
@endsection
