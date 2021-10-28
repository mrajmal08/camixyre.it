@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker dashboard-date mr-2 mb-2 mb-md-0 d-md-none d-xl-flex" id="dashboardDate">
      <span class="input-group-addon bg-transparent"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control">
    </div>
    <a href="/" target="_blank" class="btn btn-outline-info btn-icon-text mr-2 d-none d-md-block">
      <i class="btn-icon-prepend" data-feather="link-2"></i>
      Visit Site
    </a>
  </div>
</div>

<div class="row">

  <div class="col-2 col-xl-2 stretch-card">
    <div class="row flex-grow">

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-3">Total Users</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-6 col-xl-6">
                <h3 class="mb-2">{{ count($users) }}</h3>
              </div>
              <div class="col-6 col-md-6 col-xl-6">
                <div class="d-flex align-items-baseline">
                  <a href="/admin/user" class="text-success">
                    <span>View All</span>
                    <i data-feather="arrow-right" class="icon-sm mb-0"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-3">Total Orders</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-6 col-xl-6">
                <h3 class="mb-2">{{ count($orders) }}</h3>
              </div>
              <div class="col-6 col-md-6 col-xl-6">
                <div class="d-flex align-items-baseline">
                  <a href="/admin/orders" class="text-success">
                    <span>View All</span>
                    <i data-feather="arrow-right" class="icon-sm mb-0"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-3">Newsletter Emails</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-6 col-xl-6">
                <h3 class="mb-2">{{ count($newsletter) }}</h3>
              </div>
              <div class="col-6 col-md-6 col-xl-6">
                <div class="d-flex align-items-baseline">
                  <a href="/admin/newsletter" class="text-success">
                    <span>View All</span>
                    <i data-feather="arrow-right" class="icon-sm mb-0"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="col-lg-10 col-xl-10 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-3">Monthly sales @php $year = date("Y"); echo($year); @endphp</h6>
        </div>
        <p class="text-muted mb-4">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
        <div class="monthly-sales-chart-wrapper">
          <canvas id="monthly-sales-chart"></canvas>
        </div>
      </div> 
    </div>
  </div>

</div>

<div class="row">

{{-- <pre>
          @foreach ($countryVisits['rows'] as $countries)
            {{ $countries[0] }},
            {{ $countries[1] }},
          @endforeach
</pre> --}}

  <div class="col-xl-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Last 7 Days Page Views & Visitors</h6>
        <div id="apexArea"></div>
      </div>
    </div>
  </div>

  <div class="col-xl-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Most Visited Countries</h6>
        <div id="apexDonut"></div>
        <canvas id="chartjsDoughnut"></canvas>
      </div>
    </div>
  </div>

</div>


<div class="row">

  <div class="col-lg-12 col-xl-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-3">Latest Order</h6>
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

</div> <!-- row -->
@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/chartjs/Chart.min.js') }}"></script> 
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('assets/js/datepicker.js') }}"></script>
  @include('admin.asaldi-js.dashboard-js')
@endpush