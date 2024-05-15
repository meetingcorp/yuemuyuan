<label for="">รายละเอียดย่อย</label>
<div class="ml-4 mb-2">
    <label for="title1">หัวข้อ</label>
    <input type="text" name="title1" id="title1" class="form-control" value="{{$product->title1}}">
    <label for="detail1">รายละเอียด</label>
    <textarea name="detail1" id="detail1" cols="30" rows="5" class="form-control">{{$product->detail1}}</textarea><br>
    <label for="title2">หัวข้อ</label>
    <input type="text" name="title2" id="title2" class="form-control" value="{{$product->title2}}">
    <label for="detail2">รายละเอียด</label>
    <textarea name="detail2" id="detail2" cols="30" rows="5" class="form-control">{{$product->detail2}}</textarea><br>
    <label for="title3">หัวข้อ</label>
    <input type="text" name="title3" id="title1" class="form-control" value="{{$product->title3}}">
    <label for="detail3">รายละเอียด</label>
    <textarea name="detail3" id="detail3" cols="30" rows="5" class="form-control">{{$product->detail3}}</textarea>
</div>