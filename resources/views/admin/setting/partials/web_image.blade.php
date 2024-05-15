<div class="mb-3">
    <label>Favicon</label>
    <span class="text-danger">**รูปภาพขนาด 100x100 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('favicon')) }}" id="showimg1"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="favicon" type="file" class="custom-file-input"
                    id="imgInp1">
                <label class="custom-file-label" for="imgInp">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label>โลโก้ Login</label>
    <span class="text-danger">**รูปภาพขนาด 500x500 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('logologin')) }}" id="showimg2"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="logologin" type="file" class="custom-file-input"
                    id="imgInp2">
                <label class="custom-file-label" for="customfile">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label>โลโก้ Navbar</label>
    <span class="text-danger">**รูปภาพขนาด 150x150 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('logonav')) }}" id="showimg3"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="logonav" type="file" class="custom-file-input"
                    id="imgInp3">
                <label class="custom-file-label" for="customfile">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
<div class="mb-3">
    <label>OG Image</label>
    <span class="text-danger">**รูปภาพขนาด 150x150 pixel**</span>
    <div class="row align-items-center">
        <div class="col-12">
            <img src="{{ asset(setting('ogimage')) }}" id="showogimage"
                style="max-height: 100px; width: auto;">
        </div>
        <div class="col-12">
            <div class="input-group">
                <input name="ogimage" type="file" class="custom-file-input"
                    id="ogimage">
                <label class="custom-file-label" for="customfile">เพิ่มรูปภาพ</label>
            </div>
        </div>
    </div>
</div>
