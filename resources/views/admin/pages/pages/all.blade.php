@extends('admin.layouts.master')

@push('plugin-styles')
  <link href="{{ asset('assets/plugins/datatables-net/dataTables.bootstrap4.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
@endpush

@section('content')
<nav class="page-breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">Pages</a></li>
    <li class="breadcrumb-item active" aria-current="page">All Pages</li>
  </ol>
</nav>

<div class="row">
  <div class="col-md-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h6 class="card-title">Pages List</h6>

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
                <th>Created date</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody class="mb-5">
                @if($pages)
                    @foreach($pages as $page)
                    <tr>
                        <td>{{$page->title_en}}</td>
                        <td>{{$page->created_at}}</td>
                        <td>
                          <button onclick="window.location='{{route('page.edit', $page->id)}}'" type="button" class="btn btn-primary btn-icon">
                            <i data-feather="edit-3"></i>
                          </button>
                          <button onclick="showSwal('passing-parameter-execute-cancel', {{$page->id}})" type="button" class="btn btn-danger btn-icon">
                            <i data-feather="trash-2"></i>
                          </button>
                          <form id="delete-page-{{$page->id}}" action="{{route('page.destroy', $page->id)}}" method="POST">
                            @csrf
                            {{ method_field('DELETE') }}
                          </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5">No Page Found</td>
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
                  var elementID = "delete-page-" + id;
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