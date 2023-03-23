@extends('layouts.master')

@section('content')
<div class="main-content">
    <div class="title">
        Data Kost
    </div>
    <div class="content-wrapper">
        <div class="card">
            <div class="card-header">
                <h4>Form tambah data</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('kost.update', $kost->id) }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_kost" class="form-label">Nama kost</label>
                                <input type="text" class="form-control @error('nama_kost') is-invalid @enderror" name="nama_kost" id="nama_kost" value="{{ old('nama_kost', $kost->nama_kost) }}">
                                @error('nama_kost')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga kost</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="harga" value="{{ old('harga', $kost->harga) }}">
                                @error('harga')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_wa" class="form-label">Nomor WA</label>
                                <input type="text" class="form-control @error('no_wa') is-invalid @enderror" name="no_wa" id="no_wa" value="{{ old('no_wa',$kost->no_wa) }}">
                                @error('no_wa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="listrik" class="form-label">Listrik</label>
                                <select name="listrik" class="form-select" aria-label="Default select example">
                                    <option selected>--Pilih listrik / Meteran--</option>
                                    <option value="Sendiri" {{ ($kost->listrik === 'Sendiri') ? 'selected' : '' }}>Sendiri</option>
                                    <option value="Gabung" {{ ($kost->listrik === 'Gabung') ? 'selected' : '' }}>Gabung</option>
                                </select>
                                @error('listrik')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="luas_kamar" class="form-label">Luas Kamar</label>
                                <input type="text" class="form-control @error('luas_kamar') is-invalid @enderror" name="luas_kamar" id="luas_kamar" value="{{ old('luas_kamar',$kost->luas_kamar) }}">
                                @error('luas_kamar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas Kost</label>
                                <textarea class="form-control @error('fasilitas') is-invalid @enderror" id="fasilitas" name="fasilitas" rows="3">{{ old('fasilitas', $kost->fasilitas) }}</textarea>
                                @error('fasilitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="keterangan" class="form-label">Keterangan</label>
                                <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan', $kost->keterangan) }}</textarea>
                                @error('keterangan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <select name="jenis_kost" class="form-select form-select-sm mb-3 @error('jenis_kost') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Pilih jenis kost</option>
                                <option {{ ($kost->jenis_kost == 'Khusus') ? 'selected' : '' }} value="Khusus" >Khusus(Putri/Putra)</option>
                                <option {{ ($kost->jenis_kost == 'Campur') ? 'selected' : '' }} value="Campur">Campur</option>
                            </select>
                            @error('jenis_kost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <p>*gambar sebelumnya</p>
                            <img src="{{ asset($kost->gambar) }}" alt="" width="200">
                            <div class="mb-3">
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">
                                @error('gambar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                            <button type="submit" class="btn mb-2 btn-primary">
                                Update <i class="ti-save"></i>
                            </button>
                            <a href="{{ route('kost.index') }}" class="btn mb-2 btn-danger">
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