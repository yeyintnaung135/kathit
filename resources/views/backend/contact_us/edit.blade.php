@extends('layouts.backend.layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <x-alert></x-alert>
      <x-minibackheader :maintext="'Edit Contact Info'" :subtext="'Edit Contact'"/>
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Edit Contact Info</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form method="post" action="{{url('backend/contact/update/'.$contact->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                      <div class="form-group">
                        <section class="content">
                          <div class="row">
                            <div class="col-12">
                              <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Address
                                        @error('address')

                                        <span
                                            style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                        @enderror
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <textarea id="summernote" name="address" >
                                  {{old('address',$contact->address)}}</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Phone
                                        @error('phone')

                                        <span
                                            style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>

                                        @enderror
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <textarea id="summernote1" name="phone" >
                                  {{old('phone',$contact->phone)}}</textarea>
                                </div>
                              </div>
                            </div>
                            <div class="col-12">
                              <div class="card card-outline card-info">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        Email
                                        @error('email')
                                        <span
                                            style="color:red;font-size:13px;font-weight:bold;">{{ $message }}</span>
                                        @enderror
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                  <textarea id="summernote2" name="email" >
                                  {{old('email',$contact->email)}}</textarea>
                                </div>
                              </div>
                            </div>
                          </div>
                            <!-- ./row -->
                            <!-- ./row -->
                        </section>
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
@push('scripts')
    <script src="{{url('backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>

    <script>

        $(function () {
            bsCustomFileInput.init();
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
            $('#summernote2').summernote({
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
        });
    </script>
@endpush
