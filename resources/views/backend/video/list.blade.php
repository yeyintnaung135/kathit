@extends('layouts.backend.tablelayouts')
@section('title','Kathit | Banner Lists')
@push('css')
    <style>
        .photo{
            width: 100px;
            height:100px;
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-alert></x-alert>
        <x-minibackheader :maintext="'Video list'" :subtext="'video list'"/>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header row no-gutters">
                    <div class="col-12  d-flex justify-content-between">
                      <h3 class="card-title">Video list</h3>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="videoTable" class="table table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Title</th>
                          <th>Video</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @forelse ($videos as $video)
                          <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $video->title }}</td>
                            <td>{{ $video->video }}</td>
                            <td>{{ Carbon\Carbon::parse($video->created_at)->format('F d, Y') }}</td>
                            <td>
                                <a href="{{ route('backend.video.edit',$video->id )}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('backend.video.delete',$video->id )}}" onclick="return confirm('Are you sure you want to delete this video?');" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                                </a>
                            </td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="6" class="text-center">
                                      <span>There is no video</span>
                                  </td>
                              </tr>
                          @endforelse
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>

              </div>
                <!-- /.col -->
            </div>
              <!-- /.row -->
          </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@push('scripts')
<script>
  $(document).ready( function () {
    $('#videoTable').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
      ],
    });
  });
</script>

@endpush
