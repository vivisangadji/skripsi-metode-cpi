@extends('layouts.master')

@push('css')
<link href="{{ asset('') }}vendor/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('') }}vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="main-content">
    <div class="title">
        Data Perhitungan CPI
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>List Kriteria</h4>
                    </div> -->
                    <div class="card-body">
                        <a href="{{ route('cpi.create') }}" class="btn mb-3 btn-primary"><i class="ti-plus"></i> Tambah data</a>
                        <table id="DataAwal" class="table display">
                            <thead>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Fasilitas</th>
                                    <th>Jenis Kost</th>
                                    <th>Luas Kamar</th>
                                    <th>Harga</th>
                                    <th>Listrik</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_penilaian as $data)
                                <tr>
                                    <td>{{ $data->kost->nama_kost }}</td>
                                    <td>{{ $data->fasilitas }}</td>
                                    <td>{{ $data->jenis_kost }}</td>
                                    <td>{{ $data->luas_kamar }}</td>
                                    <td>{{ $data->harga }}</td>
                                    <td>{{ $data->listrik }}</td>
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('cpi.edit', $data->id) }}" class="btn me-1 btn-sm btn-success">
                                            <i class="ti-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('cpi.destroy', $data->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="confirm('Yakin ingin menghapus data?')" class="btn btn-sm btn-danger">
                                                <i class="ti-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title">
        Data Hasil Transformasi Metode CPI
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>List Kriteria</h4>
                    </div> -->
                    <div class="card-body">
                        <table id="HasilTransformasi" class="table display">
                            <thead>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Fasilitas</th>
                                    <th>Jenis Kost</th>
                                    <th>Luas Kamar</th>
                                    <th>Harga</th>
                                    <th>Listrik</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title">
        Data Hasil Perhitungan dengan Bobot
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>List Kriteria</h4>
                    </div> -->
                    <div class="card-body">
                        <table id="HasilBobot" class="table display">
                            <thead>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Fasilitas</th>
                                    <th>Jenis Kost</th>
                                    <th>Luas Kamar</th>
                                    <th>Harga</th>
                                    <th>Listrik</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($perhitunganBobot as $row)
                                <tr>
                                    <td>{{ $row['nama_kost'] }}</td>
                                    <td>{{ $row['fasilitas'] }}</td>
                                    <td>{{ $row['jenis_kost'] }}</td>
                                    <td>{{ $row['luas_kamar'] }}</td>
                                    <td>{{ $row['harga'] }}</td>
                                    <td>{{ $row['listrik'] }}</td>
                                    <td>{{ $row['jumlah'] }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title">
        Hasil Ranking
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>List Kriteria</h4>
                    </div> -->
                    <div class="card-body">
                        <table id="HasilRanking" class="table display">
                            <thead>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Total Nilai</th>
                                    <th>Ranking</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasilRank as $row)
                                <tr>
                                    <td>{{ $row['nama_kost'] }}</td>
                                    <td>{{ $row['jumlah'] }}</td>
                                    <td>{{ $loop->iteration }}</td>
                                </tr> 
                                @endforeach                               
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(function(){
    $('#DataAwal').DataTable({
        order: []
    });

    $('#HasilTransformasi').DataTable({
        processing: true,
        serverSide: true,
        language: {
            processing: "Memuat..."
        },
        ajax: "{{ route('transfor.cpi') }}",
        columns: [
            { data: 'nama_kost', name: 'nama_kost' },
            { data: 'fasilitas', name: 'fasilitas' },
            { data: 'jenis_kost', name: 'jenis_kost' },
            { data: 'luas_kamar', name: 'luas_kamar' },
            { data: 'harga', name: 'harga' },
            { data: 'listrik', name: 'listrik' },
        ],
        order: []
    });

    $('#HasilBobot').DataTable({
        order: [[6,'desc']]
    });
    
    $('#HasilRanking').DataTable({
        order: []
    });

});
</script>

<script>
    DataTable.init()
</script>
@endpush