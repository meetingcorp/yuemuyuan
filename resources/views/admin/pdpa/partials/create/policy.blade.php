<div>
    <textarea name="policies" id="polic"></textarea>
</div>
@push('js')
    <script>
        tinymce.init({
            selector: '#polic',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
            toolbar_mode: 'floating',
            height: 600,
        });
    </script>
@endpush
