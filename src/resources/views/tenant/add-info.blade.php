@extends('layout.app')
@section('title') Tenant Management | {{ getGuard() }} @endsection('title')

@section('page-styles')
{{--    Dropzone CDN --}}
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />

@endsection('page-styles')

@section('content')
<form action="{{ route('tenant.upload-info') }}"
      class="dropzone"
      id="my-awesome-dropzone"></form>
@endsection('content')

@section('script')
  <script>
     var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
     Dropzone.autoDiscover = false;
       var myDropzone = new Dropzone(".dropzone",{ 
            maxFilesize: 2, // 2 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
       });

       myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
       }); 
       myDropzone.on("success", function(file, response) {

            if(response.success == 0){ // Error
                  alert(response.error);
            }

       });
</script>
@endsection('script')