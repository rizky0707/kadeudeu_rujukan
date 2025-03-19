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
                  </span>
                  </td>                  
                <td> {{$item->keterangan}} </td>
                <td> 
                  @foreach ($item->approved_by_users as $user)
                  <span class="badge bg-warning">{{ $user->name }}</span>
                  @endforeach
                </td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</td>

                    <td>
                    <a href="{{ route('rujukan.edit', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <button type="button" class="btn btn-info btn-sm text-white" data-bs-toggle="modal" data-bs-target="#viewModal{{$item->id}}">
                      View
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="viewModal{{$item->id}}" tabindex="-1" aria-labelledby="viewModalLabel{{$item->id}}" aria-hidden="true">
                      <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="viewModalLabel{{$item->id}}">Detail Rujukan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p><strong>Nama Pasien:</strong> {{$item->nama_pasien}}</p>
                        <p><strong>Rujukan:</strong> {{ $item->rujuk_pasien_users->pluck('name')->implode(', ') }}</p>
                        <p><strong>Keterangan:</strong> {{$item->keterangan}}</p>
                        <p><strong>Approved By:</strong> {{ $item->approved_by_users->pluck('name')->implode(', ') }}</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                      </div>
                    </div>
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