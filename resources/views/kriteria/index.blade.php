@extends('layouts.master')

@push('css')
<link href="{{ asset('') }}vendor/datatables.net-dt/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="{{ asset('') }}vendor/datatables.net-responsive-dt/css/responsive.dataTables.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="main-content">
    <div class="title">
        Data Kriteria
    </div>
    <div class="content-wrapper">
        <div class="row same-height">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h4>List Kriteria</h4>
                    </div> -->
                    <div class="card-body">
                        <a href="{{ route('kriteria.create') }}" class="btn mb-3 btn-primary"><i class="ti-plus"></i> Tambah data</a>
                        <table id="example2" class="table display">
                            <thead>
                                <tr>
                                    <th>Kode Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Tren</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriterias as $kriteria)
                                <tr>
                                    <td>{{ $kriteria->kode_kriteria }}</td>
                                    <td>{{ $kriteria->nama_kriteria }}</td>
                                    <td>{{ $kriteria->bobot }}</td>
                                    <td>{{ $kriteria->tren }}</td>
                                    <td class="d-flex align-items-center">
                                        <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn me-1 btn-sm btn-success">
                                            <i class="ti-pencil-alt"></i>
                                        </a>
                                        <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST">
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
                                    <th>Kode Kriteria</th>
                                    <th>Nama Kriteria</th>
                                    <th>Bobot</th>
                                    <th>Tren</th>
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
    DataTable.init()
</script>
@endpush