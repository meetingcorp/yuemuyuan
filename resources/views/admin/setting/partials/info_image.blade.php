  {{-- <div class="mb-3">
    <label>บริการอะไหล่</label>
    <span class="text-danger">**รูปภาพขนาด 1920x1080 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12 mb-3">
            <img src="{{ asset(setting('product')) }}" id="showimg5"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="product" type="file" class="custom-file-input"
                    id="imgInp5">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label>งานวิศวกรรม</label>
    <span class="text-danger">**รูปภาพขนาด 1920x1080 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12 mb-3">
            <img src="{{ asset(setting('engi')) }}" id="engishow"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="engi" type="file" class="custom-file-input"
                    id="engi">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div> --}}
<div class="mb-3">
    <label>ข่าวสาร</label>
    <span class="text-danger">**รูปภาพขนาด 1920x1080 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12 mb-3">
            <img src="{{ asset(setting('news')) }}" id="showimg6"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="news" type="file" class="custom-file-input"
                    id="imgInp6">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label>ติดต่อเรา</label>
    <span class="text-danger">**รูปภาพขนาด 1920x1080 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12 mb-3">
            <img src="{{ asset(setting('contacts')) }}" id="contactshow"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="contacts" type="file" class="custom-file-input"
                    id="contacts">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label>รูปภาพติดต่อเรา</label>
    <span class="text-danger">**รูปภาพขนาด 1920x1080 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12 mb-3">
            <img src="{{ asset(setting('aboutus')) }}" id="showimg4"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="aboutus" type="file" class="custom-file-input"
                    id="imgInp4">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
{{-- <div class="mb-3">
    <label for="aboutus_info">เกี่ยวกับเรา (text)</label>
    <textarea name="aboutus_info" id="aboutus_info" class="form-control">{{ setting('aboutus_info') }}</textarea>
</div>
<label for="facebook_embed">เฟสบุค embed</label>
<textarea name="facebook_embed" id="facebook_embed" class="form-control" cols="30" rows="3">{{ setting('facebook_embed') }}</textarea> --}}
@push('js')
    <script>
        contacts.onchange = evt => {
            const [file] = contacts.files
            if (file) {
                contactshow.src = URL.createObjectURL(file)
            }
        }

        engi.onchange = evt => {
            const [file] = engi.files
            if (file) {
                engishow.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush
