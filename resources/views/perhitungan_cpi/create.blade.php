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
                    <form action="{{ route('cpi.store') }}" method="POST">
                        @csrf
                        <div class="col-md-6">
                            <select name="id_kost" class="form-select form-select-sm mb-3 @error('id_kost') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Pilih Kost</option>
                                @foreach($kosts as $k)
                                @if($k->status_perhitungan == 0)
                                <option value="{{$k->id}}">
                                    {{$k->nama_kost}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            @error('id_kost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select name="fasilitas" class="form-select form-select-sm mb-3 @error('fasilitas') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Fasilitas</option>
                                <option value="1">1 - 2 Fasilitas <span class="text-muted">(1)</span></option>
                                <option value="2">3 - 4 Fasilitas <span class="text-muted">(2)</span></option>
                                <option value="3">5 - 6 Fasilitas <span class="text-muted">(3)</span></option>
                                <option value="4"> > 6 Fasilitas <span class="text-muted">(4)</span></option>
                            </select>
                            @error('fasilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select name="jenis_kost" class="form-select form-select-sm mb-3 @error('jenis_kost') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Jenis Kost</option>
                                <option value="1">Kost Campur <span class="text-muted">(1)</span></option>
                                <option value="2">Khusus Pria / Putri <span class="text-muted">(2)</span></option>
                            </select>
                            @error('jenis_kost')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select name="luas_kamar" class="form-select form-select-sm mb-3 @error('luas_kamar') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Luas Kamar</option>
                                <option value="1">3 x 3 m <span class="text-muted">(1)</span></option>
                                <option value="2">3 x 4 m <span class="text-muted">(2)</span></option>
                                <option value="3">4 x 4 m <span class="text-muted">(3)</span></option>
                                <option value="4">4 x 5 m <span class="text-muted">(4)</span></option>
                            </select>
                            @error('luas_kamar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select name="harga" class="form-select form-select-sm mb-3 @error('harga') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Harga</option>
                                <option value="1">1.600.000 - 2.000.000 <span class="text-muted">(1)</span></option>
                                <option value="2">1.000.000 - 1.500.000 <span class="text-muted">(2)</span></option>
                                <option value="3">750.000 - 950.000 <span class="text-muted">(3)</span></option>
                                <option value="4">550.000 - 700.000 <span class="text-muted">(4)</span></option>
                                <option value="5">450.000 - 500.000 <span class="text-muted">(5)</span></option>
                            </select>
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <select name="listrik" class="form-select form-select-sm mb-3 @error('listrik') is-invalid @enderror" aria-label="Default select example">
                                <option selected>Tentukan Lisrtik</option>
                                <option value="1">Gabung <span class="text-muted">(1)</span></option>
                                <option value="2">Sendiri / Pribadi <span class="text-muted">(2)</span></option>
                            </select>
                            @error('listrik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                            <button type="submit" class="btn mb-2 btn-primary">
                                Simpan <i class="ti-save"></i>
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