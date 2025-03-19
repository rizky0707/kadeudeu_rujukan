@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" type="text/css">

<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title"> Data Rujukan Pasien </h3>
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
                <div class="col text-end">
                    <a href="{{route('rujukan.create')}}" class="btn btn-primary btn-sm">Create Rujukan</a>
                </div>
            </div>
            <table id="example" class="table table-bordered table-responsive nowrap">
              <thead>
                <tr>
                  <th> # </th>
                  <th> Nama Pasien</th>
                  <th> Rujukan</th>
                  <th> Keterangan</th>
                  <th>Approved By</th>
                  <th>created_at</th>
                  <th> Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no= 1; ?>
                @foreach ($rujukan as $item)   
                <tr>
                  <td> {{$no++}} </td>
                  <td> {{$item->nama_pasien}} </td>
                  <td>
                  @foreach ($item->rujuk_pasien_users as $user)
                    <span class="badge bg-secondary">{{ $user->name }}</span>
                  @endforeach
                  </td>                  
                  <td> {{$item->keterangan}} </td>
                  <td> 
                    @foreach ($item->approved_by_users as $user)
                    <span class="badge bg-warning">{{ $user->name }}</span>
                    @endforeach
                  </td>
                  <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>

                  <td>
                    <!-- Trigger Modal -->
                    <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal" data-id="{{ $item->id }}" data-nama="{{ $item->nama_pasien }}" data-keterangan="{{ $item->keterangan }}" data-rujukan="{{ $item->rujuk_pasien_users->pluck('name')->join(', ') }}" data-approved="{{ $item->approved_by_users->pluck('name')->join(', ') }}">View</button>
                    
                    <a href="{{ route('rujukan.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
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

  <!-- Modal Structure -->
  <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="viewModalLabel">Detail Rujukan Pasien</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p><strong>Nama Pasien:</strong> <span id="modal-nama"></span></p>
          <p><strong>Rujukan:</strong> <span id="modal-rujukan"></span></p>
          <p><strong>Keterangan:</strong> <span id="modal-keterangan"></span></p>
          <p><strong>Approved By:</strong> <span id="modal-approved"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<script>
  // Populate modal with data from the row clicked
  var viewModal = document.getElementById('viewModal')
  viewModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var id = button.getAttribute('data-id');
    var nama = button.getAttribute('data-nama');
    var keterangan = button.getAttribute('data-keterangan');
    var rujukan = button.getAttribute('data-rujukan');
    var approved = button.getAttribute('data-approved');
    
    var modalNama = viewModal.querySelector('#modal-nama');
    var modalKeterangan = viewModal.querySelector('#modal-keterangan');
    var modalRujukan = viewModal.querySelector('#modal-rujukan');
    var modalApproved = viewModal.querySelector('#modal-approved');
    
    modalNama.textContent = nama;
    modalKeterangan.textContent = keterangan;
    
    // Create badges for Rujukan
    modalRujukan.innerHTML = '';
    rujukan.split(', ').forEach(function(user) {
      var badge = document.createElement('span');
      badge.className = 'badge bg-secondary';
      badge.textContent = user;
      modalRujukan.appendChild(badge);
    });
    
    // Create badges for Approved By
    modalApproved.innerHTML = '';
    approved.split(', ').forEach(function(user) {
      var badge = document.createElement('span');
      badge.className = 'badge bg-warning';
      badge.textContent = user;
      modalApproved.appendChild(badge);
    });
  });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true
        });
    });
</script>

@endsection
