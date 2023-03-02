@extends('layouts.backend.layout')
@section('title','Kathit | Product Edit')
@push('styles')
  <style>
    .dropzone {
        background: white;
        border-radius: 5px;
        border: 2px dashed rgb(0, 135, 247);
        border-image: none;
        /* max-width: 500px; */
        margin-left: auto;
        margin-right: auto;
    }

    .dz-message{
        /* height: 100px; */
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .dropzone .dz-preview .dz-image img {
      height: 100%;
      object-fit: cover;
    }
    .dropzone .dz-preview .dz-image {
      border: 1px solid rgb(150, 150, 150);
    }
    .sn-multiple-selection {
      position: relative;
    }
    .sn-multiple-selection label {
      font-weight: 100 !important;
    }
    .sn-checkbox-dropdown {
        display: block;
        position: absolute;
        z-index: 999;
        background: #fff;
        border: 1px solid #cbcbcb;
        border-radius: 5px;
        top: 40px;
        width: 100%;
        min-height: 150px;
        overflow-y: scroll;
        max-height: 250px;
    }

    .sn-checkbox-dropdown input[type=checkbox] {
        -webkit-appearance: none;
        display: block;
        /* padding:10px 16px; */
        width: 100%;
        margin: 0;
        outline: none !important;
        transition: background 0.3s;
    }

    /* .sn-checkbox-dropdown label:hover {
        background: rgba(0, 0, 0, 0.1);
    } */


    .sn-checkbox-dropdown input[type=checkbox]:checked + label {
        background: rgba(0, 0, 0, 0.1);
    }

    .sn-checkbox-dropdown input[type=checkbox]:checked + label:after {
        content: '×';
        position: absolute;
        font-weight: bold;
        right: 10px;
        top: 48%;
        font-size: 18px;
        line-height: 0;
        color: #8d8d8d;
    }

    .sn-checkbox-dropdown input[type=checkbox]:after {
        display: none;
    }
    .sn-gem-list label {
        padding: 8px 16px;
        margin-bottom: 0 !important;
        position: relative;
        display: block;
    }
    .sn-gemname:after {
      content: '';
      position: absolute;
      right: 10px;
      top: 50%;
      width: 0;
      height: 0;
      border-left: 5px solid transparent;
      border-right: 5px solid transparent;
      border-top: 5px solid #cccccc;
    }
  </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-minibackheader :maintext="'Add new products'" :subtext="'add new products'"/>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">New Products</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            {{-- <form method="post" action="{{url('backend/product/update/'.$data->id)}}" enctype="multipart/form-data"> --}}
                              <input type="hidden" name="id" value="{{$data->id}}"/>  
                              {{-- @csrf --}}
                                <div class="card-body">
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-6 pr-0 pr-md-2">
                                          <label for="exampleInputEmail1">Name <span style="color:red;font-size:13px;font-weight:bold;">*</span></label>
                                          <input type="text" name="name"
                                                  class="form-control  @error('name') is-invalid @enderror "
                                                  id="exampleInputEmail1" value="{{old('name',$data->name)}}"
                                                  placeholder="Enter Name" required
                                          >


                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label>Product Type</label>
                                        <select class="form-control" name="type">
                                          <option value="readytowear" {{old('type',$data->type)=='readytowear' ? 'selected' : ''}}>Ready To Wear</option>
                                          <option value="customize" {{old('type',$data->type)=='customize' ? 'selected' : ''}}>Customize</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <div class="edit-view-photo p-3 border">
                                        @foreach ($data->getProductPhotos as $foto)
                                          <img src="{{asset($foto->product_image)}}" alt="product photo" class="w-25">
                                        @endforeach
                                      </div>
                                    </div>
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-12">
                                        <label for="customFile">Product Image <span style="color:red;font-size:13px;font-weight:bold;">*</span></label>
                                        <div id="dropzone" name="product_image">
                                          <form class="dropzone needsclick" id="demo-upload" action="/upload">
                                            <div class="dz-message needsclick">    
                                              <i class="fas fa-upload"></i>
                                            </div>
                                          </form>
                                        </div>
                                        <br/>
                                        @foreach ($data->getProductPhotos as $foto)
                                        <div id="preview-template" style="display: none;">
                                          <div class="dz-preview dz-file-preview">
                                            <div class="dz-image">
                                              <img data-dz-thumbnail="" class="w-100 dz-sn-image">
                                            </div>
                                            <div class="dz-details">
                                              <div class="dz-size">
                                                <span data-dz-size=""></span>
                                              </div>
                                              <div class="dz-filename">
                                                <span data-dz-name=""></span>
                                              </div>
                                            </div>
                                            <div class="dz-progress">
                                              <span class="dz-upload" data-dz-uploadprogress=""></span>
                                            </div>
                                            <div class="dz-error-message"><span data-dz-errormessage="">
                                              </span>
                                            </div>
                                            <div class="dz-success-mark">
                                              <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                <title>Check</title>
                                                <desc>Created with Sketch.</desc>
                                                <defs></defs>
                                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                  <path d="M23.5,31.8431458 L17.5852419,25.9283877 C16.0248253,24.3679711 13.4910294,24.366835 11.9289322,25.9289322 C10.3700136,27.4878508 10.3665912,30.0234455 11.9283877,31.5852419 L20.4147581,40.0716123 C20.5133999,40.1702541 20.6159315,40.2626649 20.7218615,40.3488435 C22.2835669,41.8725651 24.794234,41.8626202 26.3461564,40.3106978 L43.3106978,23.3461564 C44.8771021,21.7797521 44.8758057,19.2483887 43.3137085,17.6862915 C41.7547899,16.1273729 39.2176035,16.1255422 37.6538436,17.6893022 L23.5,31.8431458 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" stroke-opacity="0.198794158" stroke="#747474" fill-opacity="0.816519475" fill="#FFFFFF" sketch:type="MSShapeGroup"></path>
                                                </g>
                                              </svg>
                                            </div>
                                            <div class="dz-error-mark">
                                              <svg width="54px" height="54px" viewBox="0 0 54 54" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns">
                                                <title>error</title>
                                                <desc>Created with Sketch.</desc>
                                                <defs></defs>
                                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                                                  <g id="Check-+-Oval-2" sketch:type="MSLayerGroup" stroke="#747474" stroke-opacity="0.198794158" fill="#FFFFFF" fill-opacity="0.816519475">
                                                    <path d="M32.6568542,29 L38.3106978,23.3461564 C39.8771021,21.7797521 39.8758057,19.2483887 38.3137085,17.6862915 C36.7547899,16.1273729 34.2176035,16.1255422 32.6538436,17.6893022 L27,23.3431458 L21.3461564,17.6893022 C19.7823965,16.1255422 17.2452101,16.1273729 15.6862915,17.6862915 C14.1241943,19.2483887 14.1228979,21.7797521 15.6893022,23.3461564 L21.3431458,29 L15.6893022,34.6538436 C14.1228979,36.2202479 14.1241943,38.7516113 15.6862915,40.3137085 C17.2452101,41.8726271 19.7823965,41.8744578 21.3461564,40.3106978 L27,34.6568542 L32.6538436,40.3106978 C34.2176035,41.8744578 36.7547899,41.8726271 38.3137085,40.3137085 C39.8758057,38.7516113 39.8771021,36.2202479 38.3106978,34.6538436 L32.6568542,29 Z M27,53 C41.3594035,53 53,41.3594035 53,27 C53,12.6405965 41.3594035,1 27,1 C12.6405965,1 1,12.6405965 1,27 C1,41.3594035 12.6405965,53 27,53 Z" id="Oval-2" sketch:type="MSShapeGroup"></path>
                                                  </g>
                                                </g>
                                              </svg>
                                            </div>
                                          </div>
                                        </div>
                                        @endforeach
                                      </div>
                                    </div>
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-6 pr-md-2">
                                          <label for="exampleInputEmail1">Price (Ks) <span style="color:red;font-size:13px;font-weight:bold;">*</span></label>
                                          <input type="number" name="price"
                                                class="form-control  @error('price') is-invalid @enderror "
                                                id="exampleInputEmail1" value="{{old('price',$data->price)}}"
                                                placeholder="Enter Price" required
                                          >


                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label>Category</label>
                                        <select class="form-control" name="category_id">
                                            <option value="1" {{ old('type',$data->category_id) == '1' ? 'selected' : '' }}>Dress</option>
                                            <option value="2" {{ old('type',$data->category_id) == '2' ? 'selected' : '' }}>Myanmar Dress</option>
                                            <option value="3" {{old('type',$data->category_id) == '3' ? 'selected' : '' }}>Men's Wear</option>
                                            <option value="4" {{old('type',$data->category_id) == '4' ? 'selected' : '' }}>Women's Wear</option>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-6 pr-md-2">
                                        <label>Available Color <span style="color:red;font-size:13px;font-weight:bold;">*</span></label>
                                        <input type="hidden" id="color" name="color" value="{{ old('color') ? old('color') : $data->color }}">
                                        <div class="sn-multiple-selection">
                                          <label
                                              id="openColor"
                                              for="colors"
                                              class="sn-gemname sn-dropdown-select form-control @error('color') is-invalid @enderror"
                                          >
                                          @if (old('color'))
                                            <span>{{ count(json_decode(old('color'))) }} color(s) selected</span>
                                          @elseif ($data->color)
                                            <span>{{ count(json_decode($data->color)) }} colors(s) selected</span>
                                          @else
                                            <span>Select color</span>
                                          @endif
                                          </label>
                                          <div class="sn-checkbox-dropdown sn-dropdown-state d-none">
                                            @foreach($colors as $color)
                                              @if (in_array($color->id, old('color') ? json_decode(old('color')) : json_decode($data->color)))
                                                <div
                                                  class="sn-gem-list"
                                                >
                                                  <input
                                                      type="checkbox"
                                                      value="{{ $color->id }}"
                                                      id="{{ $color->id }}_color"
                                                      checked
                                                      onchange="checkColor(this)"
                                                  />
                                                  <label for="{{ $color->id }}_color">{{ $color->name  }}</label>
                                                </div>
                                              @else
                                                <div
                                                  class="sn-gem-list"
                                                >
                                                  <input
                                                      type="checkbox"
                                                      value="{{ $color->id }}"
                                                      id="{{ $color->id }}_color"
                                                      onchange="checkColor(this)"
                                                  />
                                                  <label for="{{ $color->id }}_color">{{ $color->name }}</label>
                                                </div>
                                              @endif
                                            @endforeach
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div class="form-group">

                                        <section class="content">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Description <span style="color:red;font-size:13px;font-weight:bold;">*</span></h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                         <textarea id="summernote1" name="short_desc" >
                                                          {{old('short_desc',$data->short_desc)}}</textarea>

                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>
                                            <!-- ./row -->
                                            <!-- ./row -->
                                        </section>
                                    </div>

                                    <div class="form-group">

                                        <section class="content">
                                            <div class="row">

                                                <div class="col-md-12">
                                                    <div class="card card-outline card-info">
                                                        <div class="card-header">
                                                            <h3 class="card-title"> About Product <span style="color:red;font-size:13px;font-weight:bold;">*</span></h3>
                                                        </div>
                                                        <!-- /.card-header -->
                                                        <div class="card-body">
                                                         <textarea id="summernote" name="description" >
                                                          {{old('description',$data->description)}}</textarea>
                                                        </div>

                                                    </div>

                                                </div>
                                                <!-- /.col-->
                                            </div>
                                            <!-- ./row -->
                                            <!-- ./row -->
                                        </section>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary float-right" id="createProduct">Submit</button>
                                </div>
                            {{-- </form> --}}
                        </div>
                        <!-- /.card -->


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
@push('scripts')
  <script src="{{url('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
  <script>
    function checkColor(checkcolor) {
      console.log('Hello')
      var color = $('#color').val();
      color = JSON.parse(color);
      if(checkcolor.checked) {
        color.push(checkcolor.value);
      } else {
        const index = color.indexOf(checkcolor.value);
        if (index !== -1) {
          color.splice(index, 1);
        }
      }
      $('#color').val(JSON.stringify(color.sort()));
      if(color.length > 0){
        $('#openColor > span').replaceWith(`<span>${color.length} color(s) selected</span>`);
      } else {
        $('#openColor > span').replaceWith(`<span>Select color</span>`);
      }
    }
    $(function () {
      $("#openColor").click(function(){
        $(".sn-dropdown-state").toggleClass("d-none");
      });
      // Summernote
      $('#summernote').summernote({
          height: 300,

          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'clear']],
              ['fontname', ['fontname']],
              ['fontsize', ['fontsize']],

              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'hr']],
              ['view', ['fullscreen', 'codeview']],
              ['help', ['help']],


          ]

      });
      $('#summernote1').summernote({
          height: 300,

          toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'italic', 'underline', 'clear']],
              ['fontname', ['fontname']],
              ['fontsize', ['fontsize']],

              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['height', ['height']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'hr']],
              ['view', ['fullscreen', 'codeview']],
              ['help', ['help']],


          ]

      })

      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
          mode: "htmlmixed",
          theme: "monokai"
      });
      bsCustomFileInput.init();
      
    })
    // let base64data = [];

    var dropzone = new Dropzone('#demo-upload', {
      previewTemplate: document.querySelector('#preview-template').innerHTML,
      parallelUploads: 2,
      thumbnailHeight: 1000,
      thumbnailWidth: 2500,
      maxFilesize: 3,
      filesizeBase: 1000,
      createImageThumbnails: true,
      maxThumbnailFilesize: 50,
      addRemoveLinks: true,
      acceptedFiles: ".jpeg,.jpg,.png,",
      init: function () {
        
      },
      thumbnail: function(file, dataUrl) {
        if (file.previewElement) {
          file.previewElement.classList.remove("dz-file-preview");
          var images = file.previewElement.querySelectorAll("[data-dz-thumbnail]");
          // console.log(file)
          // base64data.push(dataUrl)
          for (var i = 0; i < images.length; i++) {
            var thumbnailElement = images[i];
            thumbnailElement.alt = file.name;
            thumbnailElement.src = dataUrl;
          }
          setTimeout(function() { 
            file.previewElement.classList.add("dz-image-preview");
          }, 1);
        }
      }
    });
    var minSteps = 6,
        maxSteps = 60,
        timeBetweenSteps = 100,
        bytesPerStep = 100000;
    dropzone.uploadFiles = function(files) {
      var self = this;
      for (var i = 0; i < files.length; i++) {
        var file = files[i];
        totalSteps = Math.round(Math.min(maxSteps, Math.max(minSteps, file.size / bytesPerStep)));

        for (var step = 0; step < totalSteps; step++) {
        var duration = timeBetweenSteps * (step + 1);
        setTimeout(function(file, totalSteps, step) {
          return function() {
              file.upload = {
                  progress: 100 * (step + 1) / totalSteps,
                  total: file.size,
                  bytesSent: (step + 1) * file.size / totalSteps
              };
              console.log(file.size)

              self.emit('uploadprogress', file, file.upload.progress, file.upload.bytesSent);
              if (file.upload.progress == 100) {
                  file.status = Dropzone.SUCCESS;
                  self.emit("success", file, 'success', null);
                  self.emit("complete", file);
                  self.processQueue();
                  document.getElementsByClassName("dz-success-mark").style.opacity = "1";
              }
              };
          }(file, totalSteps, step), duration);
        }
      }
    }
    $("#createProduct").click(function(e){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      e.preventDefault();
      var p_image = document.querySelectorAll(".dz-sn-image");
      var product_image = [];
      p_image.forEach((pi) => {
        if(pi.src) {
          product_image.push(pi.src);
        }
      });
      var formData = {
        name: jQuery("input[name=name]").val(),
        type: jQuery("select[name=type]").val(),
        price: jQuery("input[name=price]").val(),
        category_id: jQuery("select[name=category_id]").val(),
        color: jQuery("input[name=color]").val(),
        short_desc: jQuery("textarea[name=short_desc]").val(),
        description: jQuery("textarea[name=description]").val(),
        product_image : product_image,
      }
      $.ajax({
        url: "{{ route('backend.product.update', $data->id) }}",
        method: "POST",
        data: formData,
        error:function(err) {
          console.warn(err.responseJSON.errors);
          $('.mydivclass').remove();
          $.each(err.responseJSON.errors, function (i, error) {
              var al = $(document).find('[name="'+i+'"]');              
              al.after($('<span class="mydivclass" style="color:red;font-size:13px;font-weight:bold;"> '+error[0]+'</span>'));
          });
        },
        success:function(response) {
          window.location.href = "{{ route('backend.product.list')}}";
        }
      })
    });
  </script>
@endpush
