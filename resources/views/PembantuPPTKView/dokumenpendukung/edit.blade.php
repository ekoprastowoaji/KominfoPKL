@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Dokumen Pendukung</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('PembantuPPTKView.dokumenpendukung.update', ['id' => $dokumenPendukung->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
                <label for="dpa_id">DPA:</label>
                <select name="dpa_id" id="dpa_id" class="form-control" required disabled>
                    @foreach($dpas as $dpa)
                        <option value="{{ $dpa->id }}" {{ $dokumenPendukung->dpa_id == $dpa->id ? 'selected' : '' }}>{{ $dpa->nomor_dpa }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $dokumenPendukung->nama) }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                @error('nama')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="{{ old('tanggal', $dokumenPendukung->tanggal) }}" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                @error('tanggal')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="keterangan">Keterangan</label>
                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" @if(Auth::user()->hasRole('PPTK')) disabled @endif>{{ old('keterangan', $dokumenPendukung->keterangan) }}</textarea>
                @error('keterangan')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="upload_dokumen">Upload Dokumen</label>
                <input type="file" class="form-control-file @error('upload_dokumen') is-invalid @enderror" id="upload_dokumen" name="upload_dokumen" @if(Auth::user()->hasRole('PPTK')) disabled @endif>
                @error('upload_dokumen')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="hidden" class="form-control" id="dpa_id" name="dpa_id" value="{{ old('dpa_id', $dokumenPendukung->dpa_id) }}" required>
                @error('dpa_id')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            
            @if (auth()->user()->hasRole('Pembantu PPTK'))
                <input type="hidden" name="approval" value="0">
                <input type="hidden" name="reject" value="0">
            @else
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="approval" name="approval">
                    <label class="form-check-label" for="approval">Approve</label>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="reject" name="reject">
                    <label class="form-check-label" for="reject">Reject</label>
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Update Dokumen Pendukung Data</button>
        </form>
    </div>
@endsection