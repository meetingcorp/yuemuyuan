<div>
    <textarea name="cookies" id="cook">{{$pdpa->cookies}}</textarea>
</div>
@push('js')
    <script>
        tinymce.init({
            selector: '#cook',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
            toolbar_mode: 'floating',
            height: 600,
        });
    </script>
@endpush
