@extends('layouts.master')

@push('css')
<link href="{{ asset('') }}vendor/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('') }}vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="main-content">
    <div class="title">
        Data Kost
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>List Kost</h4>
                    </div> -->
                    <div class="card-body">
                        <a href="{{ route('kost.create') }}" class="btn mb-3 btn-primary"><i class="ti-plus"></i> Tambah data</a>
                        <table id="TableData" class="table display">
                            <thead>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Gambar</th>
                                    <th>Fasilitas</th>
                                    <th>Harga</th>
                                    <th>Jenis Kost</th>
                                    <th>No WA</th>
                                    <th>Listrik</th>
                                    <th>Luas Kamar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kosts as $kost)
                                <tr>
                                    <td>{{ $kost->nama_kost }}</td>
                                    <td>
                                        <img src="{{ $kost->gambar }}" alt="{{ $kost->nama_kost }}" width="100">
                                    </td>
                                    <td>{{ $kost->fasilitas }}</td>
                                    <td>{{ rupiah($kost->harga) }}</td>
                                    <td>{{ $kost->jenis_kost }}</td>
                                    <td>{{ $kost->no_wa }}</td>
                                    <td>{{ $kost->listrik }}</td>
                                    <td>{{ $kost->luas_kamar }}</td>
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('kost.edit', $kost->id) }}" class="btn me-1 btn-sm btn-success">
                                            <i class="ti-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('kost.destroy', $kost->id) }}" method="POST">
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
                            <tfoot>
                                <tr>
                                    <th>Nama Kost</th>
                                    <th>Gambar</th>
                                    <th>Fasilitas</th>
                                    <th>Harga</th>
                                    <th>Jenis Kost</th>
                                    <th>No WA</th>
                                    <th>Listrik</th>
                                    <th>Luas Kamar</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
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
    $('#TableData').DataTable();
</script>
@endpush