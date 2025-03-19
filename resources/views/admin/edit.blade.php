@extends('layouts.app')
@section('content')


<div class="mt-3">
  <h5>
      <a href="{{ url()->previous() }}"><span  class="badge bg-secondary">< Back</span></a>

  </h5>
</div>
<h4 class="text-center"><b>Edit Form Rujukan</b></h4>

<div class="card mt-4">
  <div class="card-body">
<form method="POST" action="{{ route('rujukan.update', $rujukan->id) }}">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="namaPasien" class="form-label">Nama Pasien</label>
    <input type="text" name="nama_pasien" class="form-control" id="namaPasien" value="{{ old('nama_pasien', $rujukan->nama_pasien) }}">
    @error('nama_pasien')
      <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="rujukPasien" class="form-label">Rujuk Pasien</label>
    @foreach ($users as $user)
      <div class="form-check">
        <input type="checkbox" name="rujuk_pasien[]" value="{{ $user->id }}" class="form-check-input" id="user{{ $user->id }}" 
        {{ in_array($user->id, old('rujuk_pasien', explode(',', $rujukan->rujuk_pasien) ?? [])) ? 'checked' : '' }}>
        <label class="form-check-label" for="user{{ $user->id }}">{{ $user->name }}</label>
      </div>
    @endforeach
    @error('rujuk_pasien')
      <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan</label>
    <textarea name="keterangan" class="form-control" id="keterangan" rows="3">{{ old('keterangan', $rujukan->keterangan) }}</textarea>
    @error('keterangan')
      <div class="alert alert-danger mt-2">{{ $message }}</div>
    @enderror
  </div>
  <button type="submit" class="btn btn-primary col-md-12">Update</button>
</form>
  </div>
</div>
  

@endsection