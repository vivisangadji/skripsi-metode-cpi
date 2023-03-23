@extends('layouts.master')

@section('content')
<div class="main-content">
    <div class="title">
        Data Perhitungan CPI
    </div>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Form tambah data</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('cpi.update', $data->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-6">
                            <input type="hidden" name="id_kost" value="{{ $kost->id }}">
                            <label for="nama_kost" class="form-label">Nama Kost</label>
                            <input readonly type="text" class="form-control mb-3 @error('nama_kost') is-invalid @enderror" name="nama_kost" value="{{ old('nama_kost', $kost->nama_kost) }}">
                            @error('nama_kost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="fasilitas" class="form-label">Fasilitas</label>
                            <select name="fasilitas" class="form-select form-select-sm mb-3 @error('fasilitas') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Fasilitas</option>
                                <option value="1" {{ $data->fasilitas == 1 ? 'selected' : '' }}>
                                    1 - 2 Fasilitas 
                                    <span class="text-muted">(1)</span>
                                </option>
                                <option value="2" {{ $data->fasilitas == 2 ? 'selected' : '' }}>
                                    3 - 4 Fasilitas 
                                    <span class="text-muted">(2)</span>
                                </option>
                                <option value="3" {{ $data->fasilitas == 3 ? 'selected' : '' }}>
                                    5 - 6 Fasilitas 
                                    <span class="text-muted">(3)</span>
                                </option>
                                <option value="4" {{ $data->fasilitas == 4 ? 'selected' : '' }}> 
                                    > 6 Fasilitas 
                                    <span class="text-muted">(4)</span>
                                </option>
                            </select>
                            @error('fasilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="jenis_kost" class="form-label">Jenis Kost</label>
                            <select name="jenis_kost" class="form-select form-select-sm mb-3 @error('jenis_kost') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Jenis Kost</option>
                                <option value="1" {{ $data->jenis_kost == 1 ? 'selected' : '' }}>
                                    Kost Campur <span class="text-muted">(1)</span>
                                </option>
                                <option value="2" {{ $data->jenis_kost == 2 ? 'selected' : '' }}>
                                    Khusus Pria / Putri <span class="text-muted">(2)</span>
                                </option>
                            </select>
                            @error('jenis_kost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="luas_kamar" class="form-label">Luas Kamar Kost</label>
                            <select name="luas_kamar" class="form-select form-select-sm mb-3 @error('luas_kamar') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Luas Kamar</option>
                                <option value="1" {{ $data->luas_kamar == 1 ? 'selected' : '' }}>
                                    3 x 3 m <span class="text-muted">(1)</span>
                                </option>
                                <option value="2" {{ $data->luas_kamar == 2 ? 'selected' : '' }}>
                                    3 x 4 m <span class="text-muted">(2)</span>
                                </option>
                                <option value="3" {{ $data->luas_kamar == 3 ? 'selected' : '' }}>
                                    4 x 4 m <span class="text-muted">(3)</span>
                                </option>
                                <option value="4" {{ $data->luas_kamar == 4 ? 'selected' : '' }}>
                                    4 x 5 m <span class="text-muted">(4)</span>
                                </option>
                            </select>
                            @error('luas_kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="harga" class="form-label">Harga Kost</label>
                            <select name="harga" class="form-select form-select-sm mb-3 @error('harga') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Harga</option>
                                <option value="1" {{ $data->harga == 1 ? 'selected' : '' }}>
                                    1.600.000 - 2.000.000 <span class="text-muted">(1)</span>
                                </option>
                                <option value="2" {{ $data->harga == 2 ? 'selected' : '' }}>
                                    1.000.000 - 1.500.000 <span class="text-muted">(2)</span>
                                </option>
                                <option value="3" {{ $data->harga == 3 ? 'selected' : '' }}>
                                    750.000 - 950.000 <span class="text-muted">(3)</span>
                                </option>
                                <option value="4" {{ $data->harga == 4 ? 'selected' : '' }}>
                                    550.000 - 700.000 <span class="text-muted">(4)</span>
                                </option>
                                <option value="5" {{ $data->harga == 5 ? 'selected' : '' }}>
                                    450.000 - 500.000 <span class="text-muted">(5)</span>
                                </option>
                            </select>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="listrik" class="form-label">Listrik Kost</label>
                            <select name="listrik" class="form-select form-select-sm mb-3 @error('listrik') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Lisrtik</option>
                                <option value="1" {{ $data->listrik == 1 ? 'selected' : '' }}>
                                    Gabung <span class="text-muted">(1)</span>
                                </option>
                                <option value="2" {{ $data->listrik == 2 ? 'selected' : '' }}>
                                    Sendiri / Pribadi <span class="text-muted">(2)</span>
                                </option>
                            </select>
                            @error('listrik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                            <button type="submit" class="btn mb-2 btn-primary">
                                Update <i class="ti-save"></i>
                            </button>
                            <a href="{{ route('cpi.index') }}" class="btn mb-2 btn-danger">
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