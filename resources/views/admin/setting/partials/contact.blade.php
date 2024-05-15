<div class="row">
    <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label">ติดต่อเรา</label>
            <textarea type="text" class="form-control form-control-sm mb-5" name="contactus_detail" id="contactus_detail"
                style="height: 100px;">{{ setting('contactus_detail') }}</textarea>
        </div>
    </div>
</div>

    @push('js')
        <script type="text/javascript">
            $('#contactus_detail').summernote({
                height: 400
            });
        </script>
    @endpush
