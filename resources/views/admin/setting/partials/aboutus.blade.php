<div class="row">
    <div class="col-sm-12">
        <div class="mb-3">
            <label class="form-label">เกี่ยวกับเรา</label>
            <textarea type="text" class="form-control form-control-sm mb-5" name="aboutus_detail" id="aboutus_detail"
                style="height: 100px;">{{ setting('aboutus_detail') }}</textarea>
        </div>
    </div>
</div>

    @push('js')
        <script type="text/javascript">
            $('#aboutus_detail').summernote({
                height: 400
            });
        </script>
    @endpush
