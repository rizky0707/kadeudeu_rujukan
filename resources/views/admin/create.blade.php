@extends('layouts.app')
@section('content')

<div class="mt-3">
    <h5>
        <a href="{{ url()->previous() }}"><span  class="badge bg-secondary">< Back</span></a>

    </h5>
</div>
<h4 class="text-center"><b>Form Rujukan</b></h4>

<div class="card mt-4">
    <div class="card-body">
        <form method="POST" action="{{ route('rujukan.store') }}">
            @csrf
            <div class="mb-3">
                <label for="namaPasien" class="form-label">Nama Pasien</label>
                <input type="text" name="nama_pasien" class="form-control" id="namaPasien">
            </div>
            <div class="mb-3">
                <label for="rujukPasien" class="form-label">Rujuk Pasien</label>
                @foreach ($users as $user)
                    <div class="form-check">
                        <input type="checkbox" name="rujuk_pasien[]" value="{{ $user->id }}" class="form-check-input" id="user{{ $user->id }}">
                        <label class="form-check-label" for="user{{ $user->id }}">{{ $user->name }}</label>
                    </div>
                @endforeach
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" class="form-control" id="keterangan" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary col-md-12">Submit</button>
        </form>
    </div>
</div>

@endsection