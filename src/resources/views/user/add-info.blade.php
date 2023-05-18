@extends('layout.app')
@section('title') User info | {{ getGuard() }} @endsection('title')

@section('page-styles')
{{--    Dropzone CDN --}}
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <style>
      .dz-image img{width: 100%;height: 100%;}
    </style>
@endsection('page-styles')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="row col-md-12">
          Add User Info
        </div>
    </div>

    <div class="card-body">
      <div class="row col-md-12">
        <div class="col-md-9">

        </div>
        <div class="col-md-3">
          <form action="{{ route('user.upload-info-image') }}"
                class="dropzone"
                id="my-awesome-dropzone">
          </form>
        </div>
      </div>
    </div>
</div>


@endsection('content')

@section('script')
  <script>
     var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
     Dropzone.autoDiscover = false;
     var response = <?php echo json_encode($imagePath); ?>;
       var myDropzone = new Dropzone(".dropzone",{
            maxFilesize: 2, // 2 mb
            acceptedFiles: ".jpeg,.jpg,.png,.pdf",
            addRemoveLinks: true,
            init: function() {
              myDropzone = this;
              if (response.length > 0) {
                  $.each(response, function(key, value) {
                      var pieces = value.split(/['/']+/)
                      var last = pieces[pieces.length - 1]
                      var mockFile = { name: last, size:'1 kb'};
                      myDropzone.emit("addedfile", mockFile);
                      myDropzone.emit("thumbnail", mockFile, value);
                      myDropzone.emit("complete", mockFile);
                  });
              }
            
            },
            removedfile: function(file) {

              $.ajax({
                headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        },
                type: 'POST',
                url: '{{ url("en/user/delete-info-image") }}',
                data: {
                  filename: file.name,
                  id: {{ $id }},
                },
                success: function (data){
                    console.log("File has been successfully removed!!");
                    var _ref;
                    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
                },
                error: function(e) {
                    console.log(e);
                }
              });
            }
       });

       myDropzone.on("sending", function(file, xhr, formData) {
            formData.append("_token", CSRF_TOKEN);
            formData.append("id", {{ $id }});
       }); 
       myDropzone.on("success", function(file, response) {

            if(response.success == 0){ // Error
                  alert(response.error);
            }

       });
</script>
@endsection('script')