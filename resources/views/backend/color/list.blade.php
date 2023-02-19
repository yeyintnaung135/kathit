@extends('layouts.backend.tablelayouts')
@section('title','Kathit | Color Lists')
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
        <x-minibackheader :maintext="'Color list'" :subtext="'color list'"/>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header row no-gutters">
                    <div class="col-12  d-flex justify-content-between">
                      <h3 class="card-title">Color list</h3>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="colorTable" class="table table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Name</th>
                          <th>Color Code</th>
                          <th>Created Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $id = 1;
                        @endphp
                        @forelse ($colors as $color)
                          <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $color->name }}</td>
                            <td>{{ $color->code }}</td>
                            <td>{{ Carbon\Carbon::parse($color->created_at)->format('F d, Y') }}</td>
                            <td>
                                <a href="{{ route('backend.color.edit',$color->id )}}" class="btn btn-info btn-sm">
                                <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('backend.color.delete',$color->id )}}" onclick="return confirm('Are you sure you want to delete this color?');" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                                </a>
                            </td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="6" class="text-center">
                                      <span>There is no color</span>
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
    $('#colorTable').DataTable({
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
