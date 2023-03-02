<?php

namespace App\Http\Controllers\backend;

use App\Models\Payment;
use App\Models\OrderBillingaddress;
use App\Models\OrderProduct;

use App\Admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
  public function __construct() {
    $this->middleware('auth:admins');
  }

  public function index() {
    return view('backend.order.list');
  }

  public function get_all_orders(Request $request) {
    $draw = $request->get('draw');
      $start = $request->get("start");
      $rowperpage = $request->get("length"); // total number of rows per page

      $columnIndex_arr = $request->get('order');
      $columnName_arr = $request->get('columns');
      $order_arr = $request->get('order');
      $search_arr = $request->get('search');

      $columnIndex = $columnIndex_arr[0]['column']; // Column index
      $columnName = $columnName_arr[$columnIndex]['data']; // Column name
      $columnSortOrder = $order_arr[0]['dir']; // asc or desc
      $searchValue = $search_arr['value']; // Search value

      $searchByFromdate = $request->get('searchByFromdate');
      $searchByTodate = $request->get('searchByTodate');

      if($searchByFromdate == null) {
        $searchByFromdate = '0-0-0 00:00:00';
      }
      if($searchByTodate == null) {
        $searchByTodate = Carbon::now();
      }

      $totalRecords = Payment::select('count(*) as allcount')
                      ->where(function ($query) use ($searchValue) {
                        $query->where('id', 'like', '%' . $searchValue . '%')
                            ->orWhere('status', 'like', '%' . $searchValue . '%')
                            ->orWhere('payment_method', 'like', '%' . $searchValue . '%')
                            ->orWhere('amount', 'like', '%' . $searchValue . '%');
                      })
                      ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])->count();
      $totalRecordswithFilter = $totalRecords;

      $records = Payment::orderBy($columnName, $columnSortOrder)
          ->orderBy('created_at', 'desc')
          ->where(function ($query) use ($searchValue) {
              $query->where('id', 'like', '%' . $searchValue . '%')
                  ->orWhere('status', 'like', '%' . $searchValue . '%')
                  ->orWhere('payment_method', 'like', '%' . $searchValue . '%')
                  ->orWhere('amount', 'like', '%' . $searchValue . '%');
          })
          ->whereBetween('created_at', [$searchByFromdate, $searchByTodate])
          ->select('payment.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();

      $data_arr = array();

      foreach ($records as $record) {
          $data_arr[] = array(
              "id" => $record->id,
              "status" => $record->status,
              "payment_method" => $record->payment_method,
              "amount" => $record->amount,
              "created_at" => date('F d, Y', strtotime($record->created_at)),
              "id" => $record->id,
          );
      }

      $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordswithFilter,
          "aaData" => $data_arr,
      );
      echo json_encode($response);
  }

  public function edit($id){
    $payment = Payment::where('id', $id)->first();
    $billing = OrderBillingaddress::where('payment_id', $payment->id)->first();
    $orders = OrderProduct::where('payment_id', $payment->id)->whereIn('product_id', json_decode($payment->product_id))->get();
    return view('backend.order.detail', ['payment' => $payment, 'billing' => $billing, 'orders' => $orders]);
  }

  public function update(Request $request){
    Payment::where('id', $request->id)->update(['status' => $request->status]);
    return redirect(url('backend/order/list'));
  }
}