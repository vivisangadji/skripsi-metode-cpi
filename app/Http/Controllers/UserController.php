<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Perhitungan;
use App\Models\Kriteria;
use App\Models\Kost;

class UserController extends Controller
{
    private $minFasilitas, $minLuas, $minJenis, $minHarga, $minListrik;
    
    public function __construct(){
        $this->minFasilitas = Perhitungan::select('fasilitas')->min('fasilitas');
        $this->minJenis = Perhitungan::select('jenis_kost')->min('jenis_kost');
        $this->minLuas = Perhitungan::select('luas_kamar')->min('luas_kamar');
        $this->minHarga = Perhitungan::select('harga')->min('harga');
        $this->minListrik = Perhitungan::select('listrik')->min('listrik');
    }

    public function index(){

        return view('user_layouts.index');
    }

    public function detail($id){
        $kost = Kost::FindOrFail($id);
        return view('user_layouts.detail', compact('kost'));
    }

    public function showKostFilter(Request $request){
        $hasil = $this->kostFilter($request->fasilitas, $request->jenis_kost, $request->luas_kamar, $request->harga, $request->listrik);            
        // dd($hasil);
        return view('user_layouts.kost_filter', compact('hasil'));
    }

    public function kostFilter(Request $request){
        $fasilitas = $request->fasilitas;
        $jenis_kost = $request->jenis_kost;
        $luas_kamar = $request->luas_kamar;
        $harga = $request->harga;
        $listrik = $request->listrik;

        $data = DB::table('perhitungans')
                ->select('perhitungans.*', 'kosts.nama_kost','kosts.fasilitas AS fasilitas_kost', 'kosts.keterangan', 'kosts.gambar', 'kosts.jenis_kost AS kost_jenis', 'kosts.fasilitas AS fasilitas_kos', 'kosts.luas_kamar AS luas_kost', 'kosts.harga AS harga_kost', 'kosts.listrik AS listrik_kost')
                ->join('kosts', 'perhitungans.id_kost', '=', 'kosts.id')
                ->when($fasilitas, function ($query, $fasilitas) {
                    return $query->where('perhitungans.fasilitas', $fasilitas);
                })->when($jenis_kost, function ($query, $jenis_kost) {
                    return $query->where('perhitungans.jenis_kost', $jenis_kost);
                })->when($luas_kamar, function ($query, $luas_kamar) {
                    return $query->where('perhitungans.luas_kamar', $luas_kamar);
                })->when($harga, function ($query, $harga) {
                    return $query->where('perhitungans.harga', $harga);
                })->when($listrik, function ($query, $listrik) {
                    return $query->where('perhitungans.listrik', $listrik);
                })->get();

        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value->id_kost;
            $arrayHasil[$key]['fasilitas']  = ($value->fasilitas/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value->jenis_kost/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value->luas_kamar/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value->harga) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value->listrik) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value->nama_kost;
            $arrayHasil[$key]['gambar']     = $value->gambar;
            $arrayHasil[$key]['keterangan'] = $value->keterangan;
            $arrayHasil[$key]['jenis']       = $value->kost_jenis;
            $arrayHasil[$key]['fasilitas_kost']  = $value->fasilitas_kos;
            $arrayHasil[$key]['luas_kost']  = $value->luas_kost;
            $arrayHasil[$key]['listrik_kost']  = $value->listrik_kost;
            $arrayHasil[$key]['harga_kost'] = $value->harga_kost;

            $arrayHasil[$key]['jumlah']     = $arrayHasil[$key]['fasilitas'] + $arrayHasil[$key]['jenis_kost'] + $arrayHasil[$key]['luas_kamar'] + $arrayHasil[$key]['harga'] + $arrayHasil[$key]['listrik'];
            $arrayJumlah[$key]              = $arrayHasil[$key]['jumlah'];
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

        return view('user_layouts.kost_filter', compact('arrayHasil'));
    }

    public function allKost(){
        $hasil = $this->perhitungan();
        dd($hasil);
        return view('user_layouts.kost', compact('hasil'));
    }

    public function perhitungan(){
        $data = DB::table('perhitungans')
                    ->select('perhitungans.*', 'kosts.nama_kost','kosts.fasilitas AS fasilitas_kost', 'kosts.keterangan', 'kosts.gambar', 'kosts.jenis_kost AS kost_jenis', 'kosts.fasilitas AS fasilitas_kos', 'kosts.luas_kamar AS luas_kost', 'kosts.harga AS harga_kost', 'kosts.listrik AS listrik_kost')
                    ->join('kosts', 'perhitungans.id_kost', '=', 'kosts.id')
                    ->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value->id_kost;
            $arrayHasil[$key]['fasilitas']  = ($value->fasilitas/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value->jenis_kost/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value->luas_kamar/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value->harga) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value->listrik) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value->nama_kost;
            $arrayHasil[$key]['gambar']     = $value->gambar;
            $arrayHasil[$key]['keterangan'] = $value->keterangan;
            $arrayHasil[$key]['jenis']       = $value->kost_jenis;
            $arrayHasil[$key]['fasilitas_kost']  = $value->fasilitas_kos;
            $arrayHasil[$key]['luas_kost']  = $value->luas_kost;
            $arrayHasil[$key]['listrik_kost']  = $value->listrik_kost;
            $arrayHasil[$key]['harga_kost'] = $value->harga_kost;

            $arrayHasil[$key]['jumlah']     = $arrayHasil[$key]['fasilitas'] + $arrayHasil[$key]['jenis_kost'] + $arrayHasil[$key]['luas_kamar'] + $arrayHasil[$key]['harga'] + $arrayHasil[$key]['listrik'];
            $arrayJumlah[$key]              = $arrayHasil[$key]['jumlah'];
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

    public function perhitunganByFasilitas(){
        $data = Perhitungan::with('kost')->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value['kost']['id'] ;
            $arrayHasil[$key]['fasilitas']  = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value['jenis_kost']/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value['luas_kamar']/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value['harga']) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value['listrik']) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value['kost']['nama_kost'];
            $arrayHasil[$key]['keterangan']  = $value['kost']['keterangan'];
            $arrayHasil[$key]['jenis']       = $value['kost']['jenis_kost'];
            $arrayHasil[$key]['fasilitas_kost']  = $value['kost']['fasilitas'];
            $arrayHasil[$key]['luas_kost']  = $value['kost']['luas_kamar'];
            $arrayHasil[$key]['listrik_kost']  = $value['kost']['listrik'];
            $arrayHasil[$key]['harga_kost'] = $value['kost']['harga'];
            $arrayHasil[$key]['gambar']     = $value['kost']['gambar'];
        }

        for ($i=0; $i < count($data); $i++) { 
            for ($j=0; $j < count($data) - $i - 1; $j++) { 
                if ($arrayHasil[$j]['fasilitas'] < $arrayHasil[$j+1]['fasilitas']) {
                    $temp = $arrayHasil[$j];
                    $arrayHasil[$j] = $arrayHasil[$j+1];
                    $arrayHasil[$j+1] = $temp;
                }
            }
        }
        return $arrayHasil;
    }

    public function perhitunganByJenisKost(){
        $data = Perhitungan::with('kost')->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value['kost']['id'] ;
            $arrayHasil[$key]['fasilitas']  = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value['jenis_kost']/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value['luas_kamar']/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value['harga']) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value['listrik']) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value['kost']['nama_kost'];
            $arrayHasil[$key]['keterangan']  = $value['kost']['keterangan'];
            $arrayHasil[$key]['jenis']       = $value['kost']['jenis_kost'];
            $arrayHasil[$key]['fasilitas_kost']  = $value['kost']['fasilitas'];
            $arrayHasil[$key]['luas_kost']  = $value['kost']['luas_kamar'];
            $arrayHasil[$key]['listrik_kost']  = $value['kost']['listrik'];
            $arrayHasil[$key]['harga_kost'] = $value['kost']['harga'];
            $arrayHasil[$key]['gambar']     = $value['kost']['gambar'];
        }

        for ($i=0; $i < count($data); $i++) { 
            for ($j=0; $j < count($data) - $i - 1; $j++) { 
                if ($arrayHasil[$j]['jenis_kost'] < $arrayHasil[$j+1]['jenis_kost']) {
                    $temp = $arrayHasil[$j];
                    $arrayHasil[$j] = $arrayHasil[$j+1];
                    $arrayHasil[$j+1] = $temp;
                }
            }
        }
        return $arrayHasil;
    }

    public function perhitunganByLuasKamar(){
        $data = Perhitungan::with('kost')->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value['kost']['id'] ;
            $arrayHasil[$key]['fasilitas']  = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value['jenis_kost']/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value['luas_kamar']/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value['harga']) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value['listrik']) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value['kost']['nama_kost'];
            $arrayHasil[$key]['keterangan']  = $value['kost']['keterangan'];
            $arrayHasil[$key]['jenis']       = $value['kost']['jenis_kost'];
            $arrayHasil[$key]['fasilitas_kost']  = $value['kost']['fasilitas'];
            $arrayHasil[$key]['luas_kost']  = $value['kost']['luas_kamar'];
            $arrayHasil[$key]['listrik_kost']  = $value['kost']['listrik'];
            $arrayHasil[$key]['harga_kost'] = $value['kost']['harga'];
            $arrayHasil[$key]['gambar']     = $value['kost']['gambar'];
        }

        for ($i=0; $i < count($data); $i++) { 
            for ($j=0; $j < count($data) - $i - 1; $j++) { 
                if ($arrayHasil[$j]['luas_kamar'] < $arrayHasil[$j+1]['luas_kamar']) {
                    $temp = $arrayHasil[$j];
                    $arrayHasil[$j] = $arrayHasil[$j+1];
                    $arrayHasil[$j+1] = $temp;
                }
            }
        }
        return $arrayHasil;
    }
    
    public function perhitunganByHarga(){
        $data = Perhitungan::with('kost')->where('harga',4)->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value['kost']['id'] ;
            $arrayHasil[$key]['fasilitas']  = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value['jenis_kost']/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value['luas_kamar']/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value['harga']) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value['listrik']) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value['kost']['nama_kost'];
            $arrayHasil[$key]['keterangan']  = $value['kost']['keterangan'];
            $arrayHasil[$key]['jenis']       = $value['kost']['jenis_kost'];
            $arrayHasil[$key]['fasilitas_kost']  = $value['kost']['fasilitas'];
            $arrayHasil[$key]['luas_kost']  = $value['kost']['luas_kamar'];
            $arrayHasil[$key]['listrik_kost']  = $value['kost']['listrik'];
            $arrayHasil[$key]['harga_kost'] = $value['kost']['harga'];
            $arrayHasil[$key]['gambar']     = $value['kost']['gambar'];
        }

        for ($i=0; $i < count($data); $i++) { 
            for ($j=0; $j < count($data) - $i - 1; $j++) { 
                if ($arrayHasil[$j]['harga'] > $arrayHasil[$j+1]['harga']) {
                    $temp = $arrayHasil[$j];
                    $arrayHasil[$j] = $arrayHasil[$j+1];
                    $arrayHasil[$j+1] = $temp;
                }
            }
        }
        return $arrayHasil;
    }
    
    public function perhitunganByListrik(){
        $data = Perhitungan::with('kost')->get();
        $arrayHasil = [];
        $arrayJumlah = [];

        foreach ($data as $key => $value) {
            $arrayHasil[$key]['id'] = $value['kost']['id'] ;
            $arrayHasil[$key]['fasilitas']  = ($value['fasilitas']/$this->minFasilitas) * 100 * 0.46; 
            $arrayHasil[$key]['jenis_kost'] = ($value['jenis_kost']/$this->minJenis) * 100 * 0.26; 
            $arrayHasil[$key]['luas_kamar'] = ($value['luas_kamar']/$this->minLuas) * 100 * 0.16;
            $arrayHasil[$key]['harga']      = ($this->minHarga/$value['harga']) * 100 * 0.09; 
            $arrayHasil[$key]['listrik']    = ($this->minListrik/$value['listrik']) * 100 * 0.04;
            $arrayHasil[$key]['nama_kost']  = $value['kost']['nama_kost'];
            $arrayHasil[$key]['keterangan']  = $value['kost']['keterangan'];
            $arrayHasil[$key]['jenis']       = $value['kost']['jenis_kost'];
            $arrayHasil[$key]['fasilitas_kost']  = $value['kost']['fasilitas'];
            $arrayHasil[$key]['luas_kost']  = $value['kost']['luas_kamar'];
            $arrayHasil[$key]['listrik_kost']  = $value['kost']['listrik'];
            $arrayHasil[$key]['harga_kost'] = $value['kost']['harga'];
            $arrayHasil[$key]['gambar']     = $value['kost']['gambar'];
        }

        for ($i=0; $i < count($data); $i++) { 
            for ($j=0; $j < count($data) - $i - 1; $j++) { 
                if ($arrayHasil[$j]['listrik'] > $arrayHasil[$j+1]['listrik']) {
                    $temp = $arrayHasil[$j];
                    $arrayHasil[$j] = $arrayHasil[$j+1];
                    $arrayHasil[$j+1] = $temp;
                }
            }
        }
        return $arrayHasil;
    }
    

}
