@extends('layouts.backend.layout')
@section('title','Kathit | Product Edit')
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
                            <form method="post" action="{{url('backend/product/update/'.$data->id)}}" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="{{$data->id}}"/>  
                              @csrf
                                <div class="card-body">
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-6 pr-0 pr-md-2">
                                          <label for="exampleInputEmail1">Name
                                              @error('name')

                                              <span
                                                  style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                              @enderror
                                          </label>
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
                                    <div class="form-group row no-gutters">
                                        <div class="col-12 col-md-6 pr-md-2">
                                            <label for="customFile">Product Image
                                                @error('product_image')

                                                <span
                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                @enderror
                                            </label>

                                            <div class="custom-file">

                                                <input type="file" name="product_image" class="custom-file-input"
                                                      id="customFile">
                                                <label class="custom-file-label" for="customFile">Product Image</label>
                                                @error('product_image')
                                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 col-md-6 pr-0">
                                            <label for="customFile"> Product Gallery
                                                @error('photo_one')

                                                <span
                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                @enderror
                                            </label>

                                            <div class="custom-file">

                                                <input type="file" name="product_gallery" class="custom-file-input"
                                                       id="customFile" multiple>
                                                <label class="custom-file-label" for="customFile">Product Gallery</label>
                                                @error('photo_one')
                                                <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="form-group row no-gutters">
                                      <div class="col-12 col-md-6 pr-md-2">
                                          <label for="exampleInputEmail1">Price (Ks)
                                              @error('price')

                                              <span
                                                  style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                              @enderror
                                          </label>
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
                                        <label>Available Color
                                          @error('color')
                                            <span style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                                          @enderror
                                        </label>
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
                                                            <h3 class="card-title">
                                                                Short Description
                                                                @error('short_desc')

                                                                <span
                                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                                @enderror

                                                            </h3>
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
                                                            <h3 class="card-title">
                                                                Description
                                                                @error('description')

                                                                <span
                                                                    style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                                                @enderror

                                                            </h3>
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

                                <div class="card-footer float-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
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
@push('styles')
  <style>
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
  </script>
@endpush
