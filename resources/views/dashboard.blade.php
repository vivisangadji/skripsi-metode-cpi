@extends('layouts.master')

@push('css')
<link rel="stylesheet" href="{{ asset('') }}vendor/chart.js/dist/Chart.min.css">
@endpush

@section('content')
<div class="main-content">
    <div class="title">
        Dashboard
    </div>
    
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Perhitungan</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><span>{{ $perhitungan }}</span> <i class="ti-book"></i></h5>
                    </div>
                    <div class="card-footer">
                        Jumlah perhitungan CPI
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Kost</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><span>{{ $kost }}</span> <i class="ti-home"></i></h5>
                    </div>
                    <div class="card-footer">
                        Jumlah data kost
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        <h4>Kriteria</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><span>{{ $kriteria }}</span> <i class="ti-bar-chart"></i></h5>
                    </div>
                    <div class="card-footer">
                        Jumlah data kriteria CPI
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{ asset('') }}vendor/chart.js/dist/Chart.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script src="{{ asset('') }}assets/js/page/index.js"></script>
@endpush