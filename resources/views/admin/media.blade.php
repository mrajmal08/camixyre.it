@extends('admin.layouts.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Manage Media</h4>
  </div>
</div>

<div class="row">
    @foreach ($allMedia as $item)
    <div class="col-md-2 mb-4">
      <div class="card text-white">
        <img src="/media/{{$item}}" class="card-img-top" alt="Media Image">
        <div class="card-img-overlay">
          @php $imageName = preg_replace('/\\.[^.\\s]{3,4}$/', '', $item); @endphp
          <button onclick="showSwal('passing-parameter-execute-cancel', {{$imageName}})" type="button" class="btn btn-danger btn-icon float-right">
              <i data-feather="trash-2"></i>
          </button>
          <form id="delete-media-{{$imageName}}" action="/admin/media/destroy/{{$item}}" method="GET"></form>
        </div>
      </div>
    </div>
    @endforeach
</div>

@endsection

@push('plugin-scripts')
<script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables-net-bs4/dataTables.bootstrap4.js') }}"></script>
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
                  var elementID = "delete-media-" + id;
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