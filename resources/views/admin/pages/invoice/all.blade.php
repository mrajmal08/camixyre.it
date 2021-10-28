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
                <th>Order Status</th>
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
                            @if ($order->order_status == "pending")
                                {!! '<span class="badge badge-primary">Pending</span>' !!}
                            @elseif ($order->order_status == "completed")
                                {!! '<span class="badge badge-success">Completed</span>' !!}
                            @elseif ($order->order_status == "canceled")
                                {!! '<span class="badge badge-warning">Canceled</span>' !!}
                            @endif
                        </td>
                        <td>
                          <button onclick="window.location='{{route('invoice.edit', $order->id)}}'" type="button" class="btn btn-primary btn-icon">
                            <i data-feather="eye"></i>
                          </button>
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
  <script src="{{ asset('assets/plugins/promise-polyfill/polyfill.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/data-table.js') }}"></script>
  <script>
    $('#csv').on('click',function(){
      $("#dataTableExample").tableHTMLExport({type:'csv',filename:'sample.csv'});
    })
  </script>
@endpush