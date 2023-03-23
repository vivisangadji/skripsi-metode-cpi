<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kriteria;

class KriteriaController extends Controller
{
  
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }


    public function create()
    {
        $count = Kriteria::all()->count()+1;
        $kd_kriteria = 'C'.$count;
        return view('kriteria.create', compact('kd_kriteria'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kd_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'tren' => 'required'
        ]);
        if($validator->fails()){
            return redirect('kriteria/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        Kriteria::create([
            'kode_kriteria' => $request->kd_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'tren' => $request->tren
        ]);

        return redirect()->route('kriteria.index')
                         ->with(['success' => 'Berhasil menambah data']);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $kriteria = Kriteria::FindOrFail($id);
        return view('kriteria.edit', compact('kriteria'));
    }


    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::FindOrFail($id);
        $validator = Validator::make($request->all(), [
            'kd_kriteria' => 'required',
            'nama_kriteria' => 'required',
            'bobot' => 'required',
            'tren' => 'required'
        ]);
        if($validator->fails()){
            return redirect('kriteria/create')
                    ->withErrors($validator)
                    ->withInput();
        }

        $kriteria->update([
            'kode_kriteria' => $request->kd_kriteria,
            'nama_kriteria' => $request->nama_kriteria,
            'bobot' => $request->bobot,
            'tren' => $request->tren
        ]);

        return redirect()->route('kriteria.index')
                         ->with(['success' => 'Berhasil mengedit data']);
    }


    public function destroy($id)
    {
        Kriteria::where('id', $id)->delete();
        return redirect()->route('kriteria.index')
                         ->with(['success' => 'Berhasil menghapus data']);
    }
}
