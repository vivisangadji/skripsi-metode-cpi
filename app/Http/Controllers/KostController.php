<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Kost;

class KostController extends Controller
{

    public function index()
    {
        $kosts = Kost::all();
        return view('kost.index', compact('kosts'));
    }

    public function create()
    {
        $kosts = Kost::all();
        return view('kost.create', compact('kosts'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kost' => 'required|unique:App\Models\Kost,nama_kost',
            'harga' => 'required',
            'jenis_kost' => 'required',
            'no_wa' => 'required',
            'luas_kamar' => 'required',
            'listrik' => 'required',
            'fasilitas' => 'required',
            'keterangan' => 'required',
            'gambar' => 'required|image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return redirect('kost/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        try {
            // upload image
            $gambar = $request->file('gambar')->store('storage');
            Storage::putFile('public', $request->file('gambar'));
    
            Kost::create([
                'nama_kost' => $request->nama_kost,
                'fasilitas' => $request->fasilitas,
                'harga' => $request->harga,
                'jenis_kost' => $request->jenis_kost,
                'no_wa' => $request->no_wa,
                'luas_kamar' => $request->luas_kamar,
                'listrik' => $request->listrik,
                'keterangan' => $request->keterangan,
                'status_perhitungan' => 0,
                'gambar' => $gambar
            ]);
    
            return redirect()->route('kost.index')->with(['success' => 'Berhasil menambah data kost']);
        } catch (\Throwable $th) {
            return redirect()->route('kost.index')->with(['error' => 'Error saat menambah data kost']);
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kost = Kost::FindOrFail($id);
        return view('kost.edit', compact('kost'));
    }

    public function update(Request $request, $id)
    {
        $kost = Kost::FindOrFail($id);
        $validator = Validator::make($request->all(), [
            'nama_kost' => 'required',
            'harga' => 'required',
            'jenis_kost' => 'required',
            'no_wa' => 'required',
            'fasilitas' => 'required',
            'keterangan' => 'required',
            'luas_kamar' => 'required',
            'listrik' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg'
        ]);

        if ($validator->fails()) {
            return redirect('kost/update')
                    ->withErrors($validator)
                    ->withInput();
        }

        if ($request->hasFile('gambar')) {
            // delete old
            if (File::exists($kost->gambar)) {
                File::delete($kost->gambar);
            }

            // upload new image
            $newImage = $request->file('gambar')->store('storage');
            Storage::putFile('public', $request->file('gambar'));

            $kost->update([
                'nama_kost' => $request->nama_kost,
                'harga' => $request->harga,
                'jenis_kost' => $request->jenis_kost,
                'no_wa' => $request->no_wa,
                'fasilitas' => $request->fasilitas,
                'keterangan' => $request->keterangan,
                'luas_kamar' => $request->luas_kamar,
                'listrik' => $request->listrik,
                'gambar' => $newImage
            ]);
        }else {
            $kost->update([
                'nama_kost' => $request->nama_kost,
                'harga' => $request->harga,
                'jenis_kost' => $request->jenis_kost,
                'no_wa' => $request->no_wa,
                'fasilitas' => $request->fasilitas,
                'keterangan' => $request->keterangan,
                'luas_kamar' => $request->luas_kamar,
                'listrik' => $request->listrik
            ]);
        }

        return redirect()->route('kost.index')->with(['success' => 'Berhasil mengubah data kost']);
    }


    public function destroy($id)
    {
        $kost = Kost::FindOrFail($id);
        if (File::exists($kost->gambar)) {
            File::delete($kost->gambar);
        }

        Kost::where('id', $id)->delete();
        return redirect()->route('kost.index')->with(['success' => 'Berhasil menghapus data kost']);
    }
}
