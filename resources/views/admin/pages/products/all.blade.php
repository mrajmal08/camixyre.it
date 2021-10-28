@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Products</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Products</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Products List</h6>

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
                <th>Title</th>
                <th>Categories</th>
                <th>Product Code</th>
                <th>Product SKU</th>
                <th>Label</th>
                <th>Price</th>
                <th>Created date</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="mb-5">
                @if($products)
                    @foreach($products as $product)
                    <tr>
                        <td>{{$product->title_en}}</td>
                        <td>
                          @php
                            $categories_list = explode('|', $product->categories);
                            $show_categories = "";
                            foreach ($categories_list as $categories){
                              $show_categories .= "<span class='badge badge-info'>$categories</span> ";
                            }
                          @endphp
                          {!! $show_categories !!}
                        </td>
                        <td>
                          @php
                            $product_code = (empty($product->product_code)) ? $show_product_code = "<span class='badge badge-secondary'>None</span>" : $show_product_code = "<span class='badge badge-info'>$product->product_code</span>";
                          @endphp
                          {!! $show_product_code !!}
                        </td>
                        <td>
                          @php
                            $product_sku = (empty($product->product_sku)) ? $show_product_sku = "<span class='badge badge-secondary'>None</span>" : $show_product_sku = "<span class='badge badge-info'>$product->product_sku</span>";
                          @endphp
                          {!! $show_product_sku !!}
                        </td>
                        <td>
                          @php
                            $label = (empty($product->label)) ? $show_label = "<span class='badge badge-secondary'>None</span>" : $show_label = "<span class='badge badge-info'>$product->label</span>";
                          @endphp
                          {!! $show_label !!}
                        </td>
                        <td>
                        @if(empty($product->discount_price))
                            {{$product->price}}
                        @else
                            <strike class="text-danger">{{$product->price}} </strike> {{$product->discount_price}}
                        @endif
                        </td>
                        <td>{{ substr($product->created_at, 0, -9) }}</td>
                        <td>
                        @if($product->status == "publish")
                            <span class='badge badge-success'>Publish</span>
                        @else
                            <span class='badge badge-warning'>Draft</span>
                        @endif
                        </td>
                        <td>
                          <button onclick="window.location='{{route('product.edit', $product->id)}}'" type="button" class="btn btn-primary btn-icon">
                            <i data-feather="edit-3"></i>
                          </button>
                          <button onclick="showSwal('passing-parameter-execute-cancel', {{$product->id}})" type="button" class="btn btn-danger btn-icon">
                            <i data-feather="trash-2"></i>
                          </button>
                          <form id="delete-product-{{$product->id}}" action="{{route('product.destroy', $product->id)}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                          </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No Product Found</td>
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
                  var elementID = "delete-product-" + id;
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
@endpush