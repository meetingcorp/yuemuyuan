<div class="row">
    <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label">ชื่อเว็บไซต์</label>
            <input type="text" class="form-control form-control-sm" name="title" value="{{setting('title')}}">
        </div>

        <div class="mb-3">
            <label class="form-label">ที่ตั้งคลินิก</label>
            <input type="text" class="form-control form-control-sm" name="address" value="{{setting('address')}}">
			 <input type="text" class="mt-2 form-control form-control-sm" name="address2" value="{{setting('address2')}}">
        </div>

        <div class="mb-3">
            <label class="form-label">แผนที่</label>
            <input type="text" class="form-control form-control-sm" name="map_info" value="{{setting('map_info')}}">
        </div>

        <div class="mb-3">
            <label class="form-label">เวลาบริการ</label>
            <input type="text" class="form-control form-control-sm" name="time" value="{{setting('time')}}">
            <input type="text" class="mt-2 form-control form-control-sm" name="time2" value="{{setting('time2')}}">
        </div>

        <div class="mb-3">
            <label class="form-label">เบอร์โทรศัพท์</label>
            <input type="text" class="form-control form-control-sm" name="tel1" value="{{setting('tel1')}}">
        </div>

    </div>
</div>
