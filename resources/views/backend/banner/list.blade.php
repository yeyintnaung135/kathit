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
        <x-minibackheader :maintext="'Banner list'" :subtext="'products list'"/>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header row no-gutters">
                    <div class="col-12  d-flex justify-content-between">
                      <h3 class="card-title">Banner list</h3>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="bannerTable" class="table table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Image</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @forelse ($banner as $b)
                          <tr>
                            <td>{{ $id++ }}</td>
                            <td><img src="{{ asset($b->image)}}" alt="" class="photo"></td>
                            <td>{{ Carbon\Carbon::parse($b->created_at)->format('F d, Y') }}</td>
                            <td>
                                <a href="{{ route('backend.banner.edit',$b->id )}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('backend.banner.delete',$b->id )}}" onclick="return confirm('Are you sure you want to delete this banner?');" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                                </a>
                            </td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="6" class="text-center">
                                      <span>There is no banner</span>
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
    $('#bannerTable').DataTable({
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
