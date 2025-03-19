@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit User Status</h1>
    <form action="{{ route('rujukan.updateUser', $rujukan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-groupp">
            <label for="nama_pasien">Nama Pasien</label>
            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien" value="{{ $rujukan->nama_pasien }}" readonly>
        </div>
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $rujukan->keterangan) }}</textarea>
        </div>
    </div>
        <div class="form-group">
            <label for="status">Status</label>
            <div>
                <label>
                    <input type="radio" name="status" value="pending" {{ $rujukan->status == 'pending' ? 'checked' : '' }}>
                    Pending
                </label>
            </div>
            <div>
                <label>
                    <input type="radio" name="status" value="approved" {{ $rujukan->status == 'approved' ? 'checked' : '' }}>
                    Approved
                </label>
            </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection