@extends('adminlte::page')
@php $pagename = 'ตั้งค่าหน้าเว็บไซต์' @endphp
@section('title', setting('title') . ' | ' . $pagename)
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
@endpush
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
        <div class="col-12">
            <div class="card card-outline card-info card-tabs">
                <form method="post" action="{{ route('setting.store') }}" enctype="multipart/form-data" id="frmstore">
                    @csrf
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                            {{-- <li class="pt-2 px-3">
                                <h3 class="card-title">Card Title</h3>
                            </li> --}}
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-two-home-tab" data-toggle="pill"
                                    href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home"
                                    aria-selected="true">ทั่วไป</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-two-profile" role="tab" aria-controls="custom-tabs-two-profile"
                                    aria-selected="false">รูปภาพ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-two-messages" role="tab" aria-controls="custom-tabs-two-messages"
                                    aria-selected="false">โซเชียล</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-aboutus-tab" data-toggle="pill"
                                    href="#custom-tabs-two-aboutus" role="tab" aria-controls="custom-tabs-two-aboutus"
                                    aria-selected="false">เกี่ยวกับเรา</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-contact-tab" data-toggle="pill"
                                    href="#custom-tabs-two-contact" role="tab" aria-controls="custom-tabs-two-contact"
                                    aria-selected="false">ติดต่อเรา</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-promotion-tab" data-toggle="pill"
                                    href="#custom-tabs-two-promotion" role="tab" aria-controls="custom-tabs-two-promotion"
                                    aria-selected="false">โปรโมชั่น</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-settings-tab" data-toggle="pill"
                                    href="#custom-tabs-two-settings" role="tab" aria-controls="custom-tabs-two-settings"
                                    aria-selected="false">SEO</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-engineer-tab" data-toggle="pill"
                                    href="#custom-tabs-two-engineer" role="tab"
                                    aria-controls="custom-tabs-two-engineer " aria-selected="false">งานวิศวกรรม</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-two-repair-tab" data-toggle="pill"
                                    href="#custom-tabs-two-repair" role="tab"
                                    aria-controls="custom-tabs-two-repair " aria-selected="false">บริการอะไหล่</a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-two-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-two-home" role="tabpanel"
                                aria-labelledby="custom-tabs-two-home-tab">
                                @include('admin.setting.partials.first_page')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-two-profile-tab">
                                @include('admin.setting.partials.web_image')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-two-messages-tab">
                                @include('admin.setting.partials.social')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-aboutus" role="tabpanel"
                                aria-labelledby="custom-tabs-two-aboutus-tab">
                                @include('admin.setting.partials.aboutus')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-contact" role="tabpanel"
                            aria-labelledby="custom-tabs-two-contact-tab">
                            @include('admin.setting.partials.contact')
                        </div>
                            <div class="tab-pane fade" id="custom-tabs-two-promotion" role="tabpanel"
                                aria-labelledby="custom-tabs-two-promotion-tab">
                                @include('admin.setting.partials.promotion')
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-settings" role="tabpanel"
                                aria-labelledby="custom-tabs-two-settings-tab">
                                @include('admin.setting.partials.seo')
                            </div>
                            {{-- <div class="tab-pane fade" id="custom-tabs-two-engineer" role="tabpanel"
                                aria-labelledby="custom-tabs-two-engineer-tab">
                                <textarea name="engineer" id="engineering">{{setting('engineer')}}</textarea>
                            </div>
                            <div class="tab-pane fade" id="custom-tabs-two-repair" role="tabpanel"
                                aria-labelledby="custom-tabs-two-repair-tab">
                                <textarea name="repair" id="repaire">{{setting('repaire')}}</textarea>
                            </div> --}}
                        </div>
                    </div>
                </form>
                <div class="card-footer text-right">
                    <div class="btn-group mt-auto">
                        <button class="btn btn-info" onclick="confirmupdate()"><i
                                class="fas fa-save mr-2"></i>บันทึก</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert', ['cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@9'])
@section('plugins.Sweetalert2', true)
@push('js')
    <script>
        imgInp1.onchange = evt => {
            const [file] = imgInp1.files
            if (file) {
                showimg1.src = URL.createObjectURL(file)
            }
        }

        imgInp2.onchange = evt => {
            const [file] = imgInp2.files
            if (file) {
                showimg2.src = URL.createObjectURL(file)
            }
        }

        imgInp3.onchange = evt => {
            const [file] = imgInp3.files
            if (file) {
                showimg3.src = URL.createObjectURL(file)
            }
        }
        imgInp4.onchange = evt => {
            const [file] = imgInp4.files
            if (file) {
                showimg4.src = URL.createObjectURL(file)
            }
        }
        // imgInp5.onchange = evt => {
        //     const [file] = imgInp5.files
        //     if (file) {
        //         showimg5.src = URL.createObjectURL(file)
        //     }
        // }
        imgInp6.onchange = evt => {
            const [file] = imgInp6.files
            if (file) {
                showimg6.src = URL.createObjectURL(file)
            }
        }
        ogimage.onchange = evt => {
            const [file] = ogimage.files
            if (file) {
                showogimage.src = URL.createObjectURL(file)
            }
        }

        tinymce.init({
            selector: '#aboutus_info',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
            toolbar_mode: 'floating',
            height: '400px',
        });

        tinymce.init({
            selector: '#engineering',
            plugins: 'responsivefilemanager print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'image | responsivefilemanager | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            height: 500,
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
        tinymce.init({
            selector: '#repaire',
            plugins: 'responsivefilemanager print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
            menubar: 'file edit view insert format tools table help',
            toolbar: 'image | responsivefilemanager | undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
            height: 500,
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
                    frmstore.submit();
                }
            });
        }
    </script>
@endpush
@endsection
