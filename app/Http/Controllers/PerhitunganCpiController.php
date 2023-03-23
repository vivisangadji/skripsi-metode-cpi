<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Kost;
use App\Models\Perhitungan;
use Yajra\DataTables\DataTables;

class PerhitunganCpiController extends Controller
{
    private $minFasilitas, $minLuas, $minJenis, $minHarga, $minListrik;
    
    public function __construct(){
        $this->minFasilitas = Perhitungan::select('fasilitas')->min('fasilitas');
        $this->minJenis = Perhitungan::select('jenis_kost')->min('jenis_kost');
        $this->minLuas = Perhitungan::select('luas_kamar')->min('luas_kamar');
        $this->minHarga = Perhitungan::select('harga')->min('harga');
        $this->minListrik = Perhitungan::select('listrik')->min('listrik');
    }

    public function index()
    {
        $data_penilaian = Perhitungan::with('kost')->get();
        $perhitunganBobot = $this->perhitunganDanBobot();
        $hasilRank = $this->hasilRank();

        // dd($this->perhitunganDanBobot());
        
        return view('perhitungan_cpi.index', compact('data_penilaian','perhitunganBobot','hasilRank'));
    }

    public function transformasiCpi(){
        if (request()->ajax()) {
            $data = Perhitungan::all()
                    ->makeHidden(['id', 'id_kost', 'created_at','updated_at']);
            return DataTables::of($data)
                ->editColumn('nama_kost', function($row){
                    return $row->kost->nama_kost;
                })
                ->editColumn('fasilitas', function($row){
                    return ($row->fasilitas / $this->minFasilitas) * 100;
                })
                ->editColumn('jenis_kost', function($row){
                    return ($row->jenis_kost / $this->minJenis) * 100;
                })
                ->editColumn('luas_kamar', function($row){
                    return ($row->luas_kamar / $this->minLuas) * 100;
                })
                ->editColumn('harga', function($row){
                    return ($this->minHarga / $row->harga) * 100;
                })
                ->editColumn('listrik', function($row){
                    return ($this->minListrik / $row->listrik) * 100;
                })
                ->make(true);
        }
    }

    public function perhitunganDanBobot(){
        $data = Perhitungan::join('kosts', 'perhitungans.id_kost', '=', 'kosts.id')
                            ->select('nama_kost', 'perhitungans.fasilitas', 'perhitungans.jenis_kost',
                                    'perhitungans.luas_kamar','perhitungans.harga','perhitungans.listrik')
                            ->get();
        $arrayHasil = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['nama_kost'] = $value['nama_kost'];
            $arrayHasil[$key]['fasilitas'] = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46;
            $arrayHasil[$key]['jenis_kost'] = ($value['jenis_kost']/$this->minJenis) * 100 * 0.26;
            $arrayHasil[$key]['luas_kamar'] = ($value['luas_kamar']/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga'] = ($this->minHarga/$value['harga']) * 100 * 0.09;
            $arrayHasil[$key]['listrik'] = ($this->minListrik/$value['listrik']) * 100 * 0.04;

            $arrayHasil[$key]['jumlah'] = $arrayHasil[$key]['fasilitas'] + $arrayHasil[$key]['jenis_kost'] + $arrayHasil[$key]['luas_kamar'] + $arrayHasil[$key]['harga'] + $arrayHasil[$key]['listrik'];
        }

        return $arrayHasil;        
    }

    public function hasilRank(){
        $data = Perhitungan::join('kosts', 'perhitungans.id_kost', '=', 'kosts.id')
                            ->select('nama_kost', 'perhitungans.fasilitas', 'perhitungans.jenis_kost',
                            'perhitungans.luas_kamar','perhitungans.harga','perhitungans.listrik')
                            ->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['nama_kost'] = $value['nama_kost'];

            $arrayHasil[$key]['jumlah'] = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46 + 
                                          ($value['jenis_kost']/$this->minJenis) * 100 * 0.26 + 
                                          ($value['luas_kamar']/$this->minLuas) * 100 * 0.16 + 
                                          ($this->minHarga/$value['harga']) * 100 * 0.09 + 
                                          ($this->minListrik/$value['listrik']) * 100 * 0.04;

            $arrayJumlah[$key] = $arrayHasil[$key]['jumlah'];
        }
        rsort($arrayJumlah);

        for ($i=0; $i < count($data); $i++) { 
            for ($j=0; $j < count($data) - $i - 1; $j++) { 
                if ($arrayHasil[$j]['jumlah'] < $arrayHasil[$j+1]['jumlah']) {
                    $temp = $arrayHasil[$j];
                    $arrayHasil[$j] = $arrayHasil[$j+1];
                    $arrayHasil[$j+1] = $temp;
                }
            }
        }

        return $arrayHasil;
    }

    public function create()
    {
        $kosts = Kost::all();
        return view('perhitungan_cpi.create', compact('kosts'));
    }


    public function store(Request $request)
    {
        $kost = Kost::FindOrFail($request->id_kost);
        $validator = Validator::make($request->all(), [
            'id_kost' => 'required|unique:App\Models\Perhitungan,id_kost',
            'fasilitas' => 'required',
            'jenis_kost' => 'required',
            'luas_kamar' => 'required',
            'harga' => 'required',
            'listrik' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect('cpi/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        Perhitungan::create([
            'id_kost' => $request->id_kost,
            'fasilitas' => $request->fasilitas,
            'jenis_kost' => $request->jenis_kost,
            'luas_kamar' => $request->luas_kamar,
            'harga' => $request->harga,
            'listrik' => $request->listrik,
        ]);
        $kost->update([
            'status_perhitungan' => 1
        ]);

        return redirect()->route('cpi.index')
                         ->with(['success' => 'Berhasil menambah data']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $data = Perhitungan::FindOrFail($id);
        $kost = Kost::select('id','nama_kost')->find($data->id_kost);
        return view('perhitungan_cpi.edit', compact('data','kost'));
    }


    public function update(Request $request, $id)
    {
        $data = Perhitungan::FindOrFail($id);
        $validator = Validator::make($request->all(), [
            'id_kost' => 'required',
            'fasilitas' => 'required',
            'jenis_kost' => 'required',
            'luas_kamar' => 'required',
            'harga' => 'required',
            'listrik' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->route('cpi.edit')
                    ->withErrors($validator)
                    ->withInput();
        }

        $data->update([
            'id_kost' => $request->id_kost,
            'fasilitas' => $request->fasilitas,
            'jenis_kost' => $request->jenis_kost,
            'luas_kamar' => $request->luas_kamar,
            'harga' => $request->harga,
            'listrik' => $request->listrik,
        ]);

        return redirect()->route('cpi.index')
                         ->with(['success' => 'Berhasil mengupdate data']);
    }


    public function destroy($id)
    {
        $data = Perhitungan::FindOrFail($id);
        DB::table('kosts')
              ->where('id', $data->id_kost)
              ->update(['status_perhitungan' => 0]);
        Perhitungan::where('id', $id)->delete();
        return redirect()->route('cpi.index')
                         ->with(['success' => 'Berhasil menghapus data']);
    }
}
