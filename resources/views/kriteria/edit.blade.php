@extends('layouts.master')

@section('content')
<div class="main-content">
    <div class="title">
        Data Kriteria
    </div>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Form edit data</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('kriteria.update', $kriteria->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kd_kriteria" class="form-label">Kode Kriteria</label>
                                <input readonly type="text" class="form-control @error('kd_kriteria') is-invalid @enderror" name="kd_kriteria" id="kd_kriteria" value="{{ old('kd_kriteria', $kriteria->kode_kriteria) }}">
                                @error('kd_kriteria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Kriteria</label>
                                <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" name="nama_kriteria" value="{{ old('nama_kriteria', $kriteria->nama_kriteria) }}">
                                @error('nama_kriteria')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Bobot</label>
                                <input type="text" class="form-control @error('bobot') is-invalid @enderror" name="bobot" value="{{ old('bobot',$kriteria->bobot) }}">
                                @error('bobot')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select name="tren" class="form-select form-select-sm mb-3 @error('tren') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Pilih tren</option>
                                <option value="positif" {{ $kriteria->tren == 'positif' ? 'selected' : '' }}>Positif</option>
                                <option value="negatif" {{ $kriteria->tren == 'negatif' ? 'selected' : '' }}>Negatif</option>
                            </select>
                            @error('tren')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <button type="submit" class="btn mb-2 btn-primary">
                                Update <i class="ti-save"></i>
                            </button>
                            <a href="{{ route('kriteria.index') }}" class="btn mb-2 btn-danger">
                                Cancel <i class="ti-close"></i>
                            </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection