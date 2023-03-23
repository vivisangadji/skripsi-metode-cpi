@extends('user_layouts.master')

@section('content')
<div class="container mt-100 mt-60">
    <div class="row">
        <div class="col-lg-12">
            <div class="features-absolute blog-search">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="text-center subcribe-form">
                            
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end div-->
        </div><!--end col-->
    </div><!--end row-->
    <hr>
    @if($arrayHasil == null)
    <!-- ERROR PAGE -->
    <section class="bg-home d-flex align-items-center mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-12 text-center">
                    <img src="{{asset('user/images/404.svg')}}" class="img-fluid" alt="">
                    <div class="text-uppercase mt-4 display-3">Oh ! no</div>
                    <div class="text-capitalize text-dark mb-4 error-page">404 Not Found</div>                    
                </div><!--end col-->
            </div><!--end row-->

            <div class="row">
                <div class="col-md-12 text-center">  
                    <a href="/" class="btn btn-primary mt-4 ms-2">Kembali!</a>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <!-- ERROR PAGE -->
    @else
    <a href="/" class="btn btn-primary mt-2 mb-2">Kembali</a>
    @foreach($arrayHasil as $row)
    <div class="row align-items-center mb-3">
        <div class="col-lg-5 col-md-6 col-12">
            <img src="{{ $row['gambar'] }}" class="img-fluid shadow rounded" alt="">
        </div><!--end col-->

        <div class="col-lg-7 col-md-6 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
            <div class="section-title ms-lg-4">
                <h4 class="title mb-4">{{ $row['nama_kost'] }}</h4>
                <ul class="list-unstyled mb-0">
                    <li>
                        <h5><span class="badge bg-info text-white p-2">{{$row['jenis']}}</span></h5>
                    </li>
                    <li class="fs-5">
                        Fasilitas: <span class="text-muted">{{ $row['fasilitas_kost'] }} </span> 
                    </li>
                    <li class="fs-5">
                        Luas Kamar: <span class="text-muted">{{ $row['luas_kost'] }} </span> 
                    </li>
                    <li class="fs-5">
                        Listrik: <span class="text-muted">{{ $row['listrik_kost'] }} </span> 
                    </li>
                    <li class="fs-4">
                        $ {{rupiah($row['harga_kost'])}} / bulan
                    </li>
                    
                </ul>
                <a href="{{ route('detail.kost', $row['id']) }}" class="btn btn-outline-primary mt-3">Detail...</a>
            </div>
        </div><!--end col-->
    </div>
    @endforeach
    @endif

</div><!--end container-->
@endsection