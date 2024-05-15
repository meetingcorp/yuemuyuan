@extends('adminlte::page')
@php $pagename = 'แก้ไขสินค้า' @endphp
@section('title', setting('title') . ' | ' . $pagename)
@section('content')
    <div class="row pt-2">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb" style="background-color: transparent;">
                <li class="breadcrumb-item"><a href="{{ url('admin') }}" class="text-info"><i class="fa fa-home fa-fw"
                            aria-hidden="true"></i> หน้าแรก</a></li>
                <li class="breadcrumb-item"><a href="#" onclick="history.back()">จัดการสินค้า</a></li>
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
                        <b>แก้ไขสินค้า</b>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body"> --}}
                        <div class="form-group">
                            <form method="post" action="{{ route('product.update', ['product' => $product->id]) }}"
                                enctype="multipart/form-data" id="frmupdate">
                                @method('PUT')
                                @csrf
                                {{-- <label for="title">ชื่อสินค้า</label>
                                <input name="title" type="text" value="{{ $product->title }}" class="form-control"
                                    required> <br />
                                <label for="categorys">หมวดหมู่</label>
                                <select name="categorys[]" class="catemulti form-control" multiple="multiple">
                                    @foreach ($procate as $item)
                                        <option value="{{ $item->id }}"
                                            @if (in_array(
                                                $item->title,
                                                $product->product_category()->pluck('title')->toArray())) selected @endif>{{ $item->title }}
                                        </option>
                                    @endforeach
                                </select><br /><br />
                                <label for="price">ราคาปกติ</label>
                                <input name="price" type="number" class="form-control"
                                    value="{{ $product->normal_price }}" required><br />
                                <label for="spacialprice">ราคาพิเศษ</label>
                                <input name="spacialprice" id="spacialprice" class="form-control"
                                    value="{{ $product->spacial_price }}">
                                <br><label for="shortdetail">เนื้อหาย่อย</label><br>
                                <textarea class="form-control" name="shortdetail" id="shortdetail" cols="30" rows="3">{{ $product->short_detail }}</textarea>
                                <br>
                                <label for="detail">รายละเอียด</label><br>
                                <textarea class="form-control" name="detail" id="detail" rows="20">{{ $product->detail }}</textarea><br>
                                <label for="img">รูปภาพ</label><br>
                                <span class="text-danger">**รูปภาพขนาด 300x300 pixel**</span>
                                <div class="dropzone image-preview " id="imageDropzone">
                                    <div class="dz-message">
                                        <i class="fas fa-upload"></i><br>
                                        <span>อัพโหลดรูปภาพของคุณ!</span>
                                    </div>
                                </div>
                                <br />
                                <label>seo tag</label>
                                <input type="text" name="metatag" class="form-control" value="{{ $product->meta_tag }}">
                                <label>seo description</label>
                                <input type="text" name="metadesc" class="form-control"
                                    value="{{ $product->meta_description }}"> --}}
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
                                                <input name="title" type="text" class="form-control" value="{{$product->title}}" required>
                                                <label for="categorys">หมวดหมู่</label>
                                                {{-- {{$product->sub_categories_id}} --}}
                                                <select name="categorys" class="catemulti form-control">
                                                    @foreach ($procate as $item)
                                                        <option value="{{ $item->id }}"
                                                            @if ($product->sub_categories_id == $item->id) selected @endif>{{ $item->title }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="price">ราคา</label>
                                                <input name="price" type="number" class="form-control" value="{{ $product->normal_price }}" required>
                                                <label>ราคาพิเศษ</label>
                                                <input type="number" name="spacialprice" value="{{ $product->spacial_price }}" class="form-control">
                                            </div>
                                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                                aria-labelledby="custom-tabs-two-profile-tab">
                                                <label for="shortdetail">เนื้อหาย่อ</label><br>
                                                <textarea class="form-control" name="shortdetail" id="shortdetail" cols="30" rows="3">{{ $product->short_detail }}</textarea>
                                                <br>
                                                <label for="detail">รายละเอียด</label><br>
                                                <textarea class="form-control" name="detail" id="detail" cols="30" rows="10">{{ $product->detail }}</textarea><br>
                                                @include('admin.product.productall.partials.edit.subdetail')
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
                                                <input class="form-control" type="text" name="metatag" value="{{ $product->meta_tag }}">
                                                <label>SEO Description</label>
                                                <input class="form-control" type="text" name="metadesc" value="{{ $product->meta_description }}">
                                            </div>
                                        </div>
                                    </div>
                            </form>
                            <div class="float-right mt-2">
                                <a class="btn btn-secondary" onclick="history.back();"><i
                                        class="fas fa-arrow-left mr-2"></i>ย้อนกลับ</a>
                                <button class="btn btn-info" id="btnsubmit" onclick="confirmupdate()"><i
                                        class="fas fa-save mr-2"></i>บันทึก</button>
                            </div>
                        </div>
                    {{-- </div> --}}

                </div>
            </div>
        </div>
    </div>
    </div>
@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
        integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
        crossorigin="anonymous"></script>
    <script>
        // imgInp.onchange = evt => {
        //     const [file] = imgInp.files
        //     if (file) {
        //         showimg.src = URL.createObjectURL(file)
        //     }
        // }

        $(document).ready(function() {
            $('.catemulti').select2();
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
                            url: "{{route('dropzone.delete')}}",
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
