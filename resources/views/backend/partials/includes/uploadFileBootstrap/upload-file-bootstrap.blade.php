

{{-- @extends('backend.layouts.master') --}}
@push('stylesheets')
<link href="{{ asset('bootstrap-fileinput-master/css/fileinput.min.css') }}" media="all" rel="stylesheet" type="text/css"/>

@endpush

       <form enctype="multipart/form-data">
        <label>Importation des bulletins</label>
        <div class="file-loading">
            @csrf
            <input id="file-fr" name="bulletins" type="file" multiple>
        </div>
    </form>


@push('scripts')
    <script src="{{ asset('bootstrap-fileinput-master/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput-master/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput-master/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput-master/js/locales/fr.js') }}" type="text/javascript"></script>
    {{-- <script src="{{ asset('bootstrap-fileinput-master/js/locales/es.js') }}" type="text/javascript"></script> --}}
    <script src="{{ asset('bootstrap-fileinput-master/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('bootstrap-fileinput-master/themes/explorer-fas/theme.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
    	$('#file-fr').fileinput({
        theme: 'fas',
        language: 'fr',
        uploadUrl: '{{ route('jury.storeBulletin',[$annee,$session,$auditoire]) }}',
        allowedFileExtensions: ['pdf'],
        uploadExtraData: function(){
            return {
                _token : $("input[name = '_token']").val(),
            }
        }
    });
    </script>

@endpush