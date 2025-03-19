@extends('layouts.app-user')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" type="text/css">

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Data Rujukan Anda </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                <li class="breadcrumb-item active" aria-current="page">Basic tables</li>
            </ol>
        </nav>
    </div>
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col">
                            <h6 class="m-0 font-weight-bold text-primary card-title">Data Rujukan Pasien</h6>
                        </div>
                    </div>
                    <table id="example" class="table table-bordered table-responsive nowrap">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Pasien</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>DateTime</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rujukan as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->nama_pasien }}</td>
                                <td>{{ \Illuminate\Support\Str::words($item->keterangan, 2) }} </td>
                                <td>
                                    @if (in_array($userId, $item->approved_by_array))
                                    <span class="badge bg-success">Approved</span>
                                    @else
                                    <span class="badge bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->diffForHumans() }}</td>
                                <td>
                                    @if (!in_array($userId, $item->approved_by_array))
                                    <form action="{{ route('rujukan.approve', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Approve</button>
                                    </form>
                                    @else
                                    <button class="btn btn-secondary btn-sm" disabled>Approved</button>
                                    @endif

                                    <!-- Show Details Button -->
                                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="{{ $item->id }}" data-nama="{{ $item->nama_pasien }}" data-keterangan="{{ $item->keterangan }}" data-status="{{ in_array($userId, $item->approved_by_array) ? 'Approved' : 'Pending' }}">Show Details</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for showing additional details -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewModalLabel">Detail Rujukan Pasien</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <p><strong>Nama Pasien:</strong> <span id="modal-nama"></span></p>
                <p><strong>Keterangan:</strong> <span id="modal-keterangan"></span></p>
                <p><strong>Status:</strong> <span id="modal-status"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#example').DataTable({
            responsive: true
        });
      });
</script>
<script>

var viewModal = document.getElementById('viewModal')
  viewModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var id = button.getAttribute('data-id');
    var nama = button.getAttribute('data-nama');
    var keterangan = button.getAttribute('data-keterangan');
    var status = button.getAttribute('data-status');
    
    var modalNama = viewModal.querySelector('#modal-nama');
    var modalKeterangan = viewModal.querySelector('#modal-keterangan');
    
    var modalStatus = viewModal.querySelector('#modal-status');

    modalNama.textContent = nama;
    modalKeterangan.textContent = keterangan;
    modalStatus.textContent = status;
        
      });
</script>

@endsection
