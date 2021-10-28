@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <div class="row">
    <div class="col-6">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Orders</a></li>
        <li class="breadcrumb-item active" aria-current="page">All Orders</li>
      </ol>
    </div>
    <div class="col-6">
      <p class="lead text-right">
        <button id="csv" class="btn btn-info">DOWNLOAD CSV</button>
      </p>
    </div>
  </div>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Orders List</h6>

        <div class="col-12 p-0">
          @if(session()->has('message'))
            <div class="alert alert-success">
              {{session('message')}}
            </div>
          @endif
        </div>

        <div class="table-responsive">
          <table id="dataTableExample" class="table">
            <thead>
              <tr>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>Payment Method</th>
                <th>Order Status</th>
                <th>Order Region</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="mb-5">
                @if($orders)
                    @foreach($orders as $order)
                    <tr>
                        <td>#{{$order->order_number}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>
                            @if ($order->payment_type == "PayPal")
                                {!! '<span class="badge badge-primary">PayPal</span>' !!}
                            @elseif ($order->payment_type == "Bank Transfer")
                                {!! '<span class="badge badge-info">Bank Transfer</span>' !!}
                            @elseif ($order->payment_type == "COD")
                                {!! '<span class="badge badge-warning">Cash On Delivery</span>' !!}
                            @endif
                        </td>
                        <td>
                            @if ($order->order_status == "pending")
                                {!! '<span class="badge badge-primary">Pending</span>' !!}
                            @elseif ($order->order_status == "shipped")
                                {!! '<span class="badge badge-primary">Shipped</span>' !!}
                            @elseif ($order->order_status == "completed")
                                {!! '<span class="badge badge-success">Completed</span>' !!}
                            @elseif ($order->order_status == "canceled")
                                {!! '<span class="badge badge-warning">Canceled</span>' !!}
                            @endif
                        </td>
                        <td>
                            @if ($order->site_region == "en")
                                {!! '<span class="badge badge-light">Global</span>' !!}
                            @elseif ($order->site_region == "it")
                                {!! '<span class="badge badge-light">Italy</span>' !!}
                            @elseif ($order->site_region == "fr")
                                {!! '<span class="badge badge-light">France</span>' !!}
                            @elseif ($order->site_region == "es")
                                {!! '<span class="badge badge-light">Spanish</span>' !!}
                            @elseif ($order->site_region == "de")
                                {!! '<span class="badge badge-light">German</span>' !!}
                            @endif
                        </td>
                        <td>
                          <button onclick="window.location='{{route('order.edit', $order->id)}}'" type="button" class="btn btn-primary btn-icon">
                            <i data-feather="eye"></i>
                          </button>
                          <button onclick="showSwal('passing-parameter-execute-cancel', {{$order->id}})" type="button" class="btn btn-danger btn-icon">
                            <i data-feather="trash-2"></i>
                          </button>
                          <form id="delete-order-{{$order->id}}" action="{{route('order.destroy', $order->id)}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                          </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No Order Found</td>
                    </tr>
                @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('assets/plugins/export-table-json-csv-txt-pdf/tableHTMLExport.js') }}"></script>
  <script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script>
    $(function() {
      showSwal = function(type, id) {
      'use strict';
        if (type === 'passing-parameter-execute-cancel') {
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false,
          })
          
          swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'ml-2',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
              swalWithBootstrapButtons.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              ).then(function() {
                  var elementID = "delete-order-" + id;
                  document.getElementById(elementID).submit();
              });
            } else if (
              // Read more about handling dismissals
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
              )
            }
          })
        }
      }
    });
  </script>
  <script>
    $('#csv').on('click',function(){
      $("#dataTableExample").tableHTMLExport({type:'csv',filename:'sample.csv'});
    })
  </script>
@endpush