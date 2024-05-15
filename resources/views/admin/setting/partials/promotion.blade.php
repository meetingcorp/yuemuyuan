<div class="mb-3">
    <label>Promotion</label>
    <span class="text-danger">**รูปภาพขนาด 1920x700 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('promotion_img')) }}" id="promotionshow"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="promotion_img" type="file" class="custom-file-input"
                    id="promotion_img">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label>Promotion Mobile</label>
    <span class="text-danger">**รูปภาพขนาด 700x500 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('promotion_img_mobile')) }}" id="promotionshow"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="promotion_img_mobile" type="file" class="custom-file-input"
                    id="promotion_img_mobile">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
		
        promotion_img.onchange = evt => {
            const [file] = promotion_img.files
            if (file) {
                promotionshow.src = URL.createObjectURL(file)
            }
        }
		
		promotion_img_mobile.onchange = evt => {
            const [file] = promotion_img_mobile.files
            if (file) {
                promotionshow.src = URL.createObjectURL(file)
            }
        }
    </script>
@endpush


