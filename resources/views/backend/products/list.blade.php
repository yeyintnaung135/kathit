@extends('layouts.backend.tablelayouts')
@section('title','Kathit | Product Lists')
@push('css')
    <style>
        .photo{
            width: 100px;
            height:100px;
            object-fit: cover;
        }
    </style>
@endpush
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <x-alert></x-alert>
        <x-minibackheader :maintext="'Products list'" :subtext="'products list'"/>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header row no-gutters">
                                <div class="col-12  d-flex justify-content-between">
                                    <h3 class="card-title">Products list</h3>
                                </div>

                             

                            </div>
                            <!-- /.card-header -->
                             <div class="card-body">
                                {{-- <div class="d-flex justify-content-end my-3 align-items-end"> --}}
                                <div class="d-none justify-content-end my-3 align-items-end">
                                  <div class="form-group m-0 mr-1">
                                    <fieldset>
                                      <legend class="small m-0">From Date</legend>
                                      <input type="text" id='search_fromdate_products' class="productsdatepicker form-control" placeholder='Choose date' autocomplete="off"/>
                                    </fieldset>
                                  </div>
                                  <div class="form-group m-0 mr-1">
                                    <fieldset>
                                      <legend class="small m-0">To Date</legend>
                                      <input type="text" id='search_todate_products' class="productsdatepicker form-control" placeholder='Choose date' autocomplete="off"/>
                                    </fieldset>
                                  </div>
                                  <div class="pr-md-4">
                                    <input type='button' id="products_search_button" value="Search" class="btn bg-info"  >
                                  </div>
                                </div>

                                <table id="productsTable" class="table table-borderless table-hover">
                                  <thead>
                                    <tr>
                                      <th>id</th>
                                      <th>Name</th>
                                      <th>Photo</th>
                                      <th>Price</th>
                                      <th>Create Date</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
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

    var productsTable = $('#productsTable').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
      "url": "{{ url('backend/product/get_all_products') }}",
      'data': function(data){
            // Read values
            var from_date = $('#search_fromdate_products').val() ? $('#search_fromdate_products').val() + " 00:00:00" : null;
            var to_date = $('#search_todate_products').val() ? $('#search_todate_products').val() + " 23:59:59" : null;

            // Append to data
            data.searchByFromdate = from_date;
            data.searchByTodate = to_date;
        }
      },
      columns: [
        {data: 'id'},

        {data: 'name'},
        {
          data: 'product_image',
          render: function(data, type) {
            var image = `<img class="photo" src="{{url(':img')}}">`;
            image = image.replace(':img', data);
            return image;
          }
        },
        {
          data: 'price',
          render: function(data, type) {
            var price = data + " MMK";
            return price;
          }
        },
        {data: 'created_at'},
        {
          data: 'id',
          render: function(data, type) {
            var detail = `<a href="{{url('product/detail/'. ':id')}}" type="button" class="btn btn-primary btn-sm mr-2">
                            <i class="fa fa-info-circle"></i>
                          </a>`;
            var edit = `<a href="{{url('backend/product/edit/'.':id')}}" type="button" class="btn btn-info btn-sm mr-2">
                            <i class="fa fa-edit"></i>
                        </a>`;
            var del = ` <form action="{{ url('backend/product/delete/'.':id')}}" method="post" id="deleteForm">
                               @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure')"><i class="fa fa-trash"></i></button>
                              </form>
                    `;
            detail=detail.replace(':id', data);
            edit=edit.replace(':id', data);
            del=del.replace(':id', data);
            return '<div class="d-flex">' + detail + edit + del + '</div>';
          }
        }
      ],
      responsive: true,
      lengthChange: true,
      autoWidth: false,
      paging: true,
      dom: 'Blfrtip',
      buttons: ["copy", "csv", "excel", "pdf", "print"],
      columnDefs: [
        { responsivePriority: 1, targets: 1 },
        { responsivePriority: 2, targets: 2 },
        { responsivePriority: 3, targets: 3},
        { responsivePriority: 4, targets: 4},
        {
          'targets': [5],
          'orderable': false,
        }
      ],
      language: {
        // "search" : '<i class="fa fa-search"></i>',
        // "searchPlaceholder": 'Search ...',
        // paginate: {
        //   next: '<i class="fa fa-angle-right"></i>', // or '→'
        //   previous: '<i class="fa fa-angle-left"></i>' // or '←'
        // }
      },

      "order": [[ 4, "desc" ]],

    });

  // $(document).ready(function() {
  //   $( ".productsdatepicker" ).datepicker({
  //       "dateFormat": "yy-mm-dd",
  //       changeYear: true
  //   });

  //   $('#products_search_button').click(function(){
  //     if($('#search_fromdate_products').val() != null && $('#search_todate_products').val() != null) {
  //       productsTable.draw();
  //     }
  //   });

  //   $( ".productsactdatepicker" ).datepicker({
  //       "dateFormat": "yy-mm-dd",
  //       changeYear: true
  //   });

  //   $('#productsact_search_button').click(function(){
  //     if($('#search_fromdate_productsact').val() != null && $('#search_todate_productsact').val() != null) {
  //       productsTable.draw();
  //     }
  //   });
  // });
  </script>

@endpush
