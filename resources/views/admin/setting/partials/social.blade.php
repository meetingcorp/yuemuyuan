

<div class="mb-3">
    <label for="facebook_info">Facebook</label>
    <input class="form-control" type="text" name="facebook_info"
        value="{{ setting('facebook_info') }}">
</div>

<div class="mb-3">
    <label for="line_info">Line</label>
    <input class="form-control" type="text" name="line_info"
        value="{{ setting('line_info') }}">
</div>

<div class="mb-3">
    <label for="tel1">Youtube</label>
    <input class="form-control" type="text" name="youtube_info"
        value="{{ setting('youtube_info') }}">
</div>

<div class="mb-3">
    <label for="messenger_info">Messenger</label>
    <input class="form-control" type="text" name="messenger_info"
        value="{{ setting('messenger_info') }}">
</div>

<div class="mb-3">
    <label>QR-Code Facebook</label>
    <span class="text-danger">**รูปภาพขนาด 150x150 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('qrcode_facebook')) }}" id="qrcode_facebookshow"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="qrcode_facebook" type="file" class="custom-file-input"
                    id="qrcode_facebook">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>

<div class="mb-3">
    <label>QR-Code Line</label>
    <span class="text-danger">**รูปภาพขนาด 150x150 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('qrcode_line')) }}" id="qrcode_lineshow"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="qrcode_line" type="file" class="custom-file-input"
                    id="qrcode_line">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        qrcode_facebook.onchange = evt => {
            const [file] = qrcode_facebook.files
            if (file) {
                qrcode_facebookshow.src = URL.createObjectURL(file)
            }
        }
        qrcode_line.onchange = evt => {
            const [file] = qrcode_line.files
            if (file) {
                qrcode_lineshow.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush

{{-- <div class="mb-3">
    <label for="facebook_embed">Facebook Embed</label>
    <textarea class="form-control" name="facebook_embed" id="facebook_embed" cols="30" rows="3">{{ setting('facebook_embed') }}</textarea>
</div> --}}

{{-- <div class="mb-3">
    <label for="map_info">Google Map</label>
    <textarea class="form-control" name="map_info" id="map_info" cols="30" rows="3">{{ setting('map_info') }}</textarea>
</div> --}}
