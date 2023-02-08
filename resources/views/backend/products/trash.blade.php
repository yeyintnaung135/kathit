@extends('layouts.backend.tablelayouts')
@section('title','Kathit | Product Trash Lists')
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
        <x-minibackheader :maintext="'Products Trash list'" :subtext="'products list'"/>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header row no-gutters">
                    <div class="col-12  d-flex justify-content-between">
                      <h3 class="card-title">Products Trash list</h3>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="productsTrashTable" class="table table-borderless table-hover">
                      <thead>
                        <tr>
                          <th>id</th>
                          <th>Name</th>
                          <th>Photo</th>
                          <th>Price</th>
                          <th>Deleted Date</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $id = 1;
                        @endphp
                        {{-- {{ print_r($products) }} --}}
                        @forelse ($products as $p)
                          <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $p->name }}</td>
                            <td>
                              <img class="photo" src="{{url($p->product_image)}}">
                            </td>
                            <td>{{ $p->price }} MMK</td>
                            <td>{{ Carbon\Carbon::parse($p->deleted_at)->format('F d, Y') }}</td>
                            <td>
                              <div class="d-flex">
                                <a href="{{ url('/backend/product/restore/'.$p->id )}}" class="btn btn-info btn-sm mr-2"> <i class="fas fa-trash-restore"></i></a>
                                <form action="{{ url('/backend/product/force_delete/'.$p->id )}}" method="post" id="productDelete" >
                                      @csrf
                                      @method('DELETE')
                                </form>
                                <button type="submit" form="productDelete" onclick="return confirm('Are you sure you want to delete this product?');" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i> 
                                </button>
                              </div>
                            </td>
                          </tr>
                          @empty
                              <tr>
                                  <td colspan="6" class="text-center">
                                      <span>There is no product trash</span>
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
    $('#productsTrashTable').DataTable({
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
