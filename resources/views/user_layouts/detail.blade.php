@extends('user_layouts.master')

@section('content')
<section class="section pb-0">
    <div class="container">
        <div class="row align-items-center mb-2 pb-2">
            <div class="col-md-8">
                <div class="section-title text-center text-md-start">
                    <h3 class="mb-4">Detail Kost</h3>
                </div>
            </div><!--end col-->
        </div><!--end row-->
        <div class="row align-items-center m-auto">
            <div class="col-md-4">
                <div class="tiny-single-item">
                    <div class="tiny-slide"><img src="{{asset($kost->gambar)}}" class="img-fluid rounded" alt=""></div>
                </div>
            </div><!--end col-->
            <div class="col-md-7 mt-sm-0 pt-2 pt-sm-0">
                <div class="section-title ms-md-4">
                    <h4 class="title">{{ $kost->nama_kost }}</h4>
                    <span class="badge bg-info text-white p-2">{{ $kost->jenis_kost }}</span>
                    <h5 class="text-muted">{{ rupiah($kost->harga) }}/bulan </h5>

                    <h5 class="mt-3 mb-0">Fasilitas :</h5>
                    <p class="text-muted">{{ $kost->fasilitas }}</p>
                    <h5 class="mt-3 mb-0">Keterangan :</h5>
                    <p class="text-muted">{{ $kost->keterangan }}</p>
                    <h5 class="mt-3 mb-0">Listrik :</h5>
                    <p class="text-muted">{{ $kost->listrik }}</p>
                    <h5 class="mt-3 mb-0">Luas Kamar :</h5>
                    <p class="text-muted">{{ $kost->luas_kamar }}</p>
                    <h5 class="mt-3 mb-0">Kontak :</h5>
                    <p class="text-muted">Hubungi: {{ $kost->no_wa }}</p>

                    <div class="mt-4 mb-5 pt-2">
                        <a href="/" class="btn btn-primary">Kembali</a>
                    </div>
                </div>
            </div><!--end col-->
        </div>
    </div>
</div>
@endsection