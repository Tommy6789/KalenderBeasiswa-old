<?php

namespace App\Http\Controllers;

use App\Models\kalender_beasiswa;
use App\Models\Negara;
use App\Models\tingkat_studi;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function homepage()
    {
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->get();
        $negara = Negara::all();
        $tingkat_studi = tingkat_studi::all();


        return view('frontend.homepage', [
            'data' => $data,
            'negara' => $negara,
            'tingkat_studi' => $tingkat_studi
        ]);
    }

    // public function detail()
    // {
    //     $data = kalender_beasiswa::with('negara', 'tingkat_studi')->get();
    //     $negara = Negara::all();
    //     $tingkat_studi = tingkat_studi::all();

    //     return view('frontend.detail', [
    //         'data' => $data,
    //         'negara' => $negara,
    //         'tingkat_studi' => $tingkat_studi
    //     ]);
    // }

    public function detail($id)
    {
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->findOrFail($id);
        $negara = Negara::all();
        $tingkat_studi = tingkat_studi::all();
    
        return view('frontend.detail', [
            'data' => $data,
            'negara' => $negara,
            'tingkat_studi' => $tingkat_studi
        ]);
    }
    
    public function filter(Request $request)
{
    $query = kalender_beasiswa::query();

    // Track if the filter is applied
    $isJenisBeasiswaFiltered = $request->has('jenis_beasiswa');

    // Filter by Tingkat Studi
    if ($request->has('id_tingkat_studi')) {
        $query->whereHas('tingkat_studi', function($q) use ($request) {
            $q->whereIn('tingkat_studis.id', $request->id_tingkat_studi);
        });
    }

    // Filter by Jenis Beasiswa
    if ($isJenisBeasiswaFiltered) {
        $query->whereIn('jenis_beasiswa', $request->jenis_beasiswa);
    }

    // Filter by Negara
    if ($request->has('id_negara')) {
        $query->whereHas('negara', function($q) use ($request) {
            $q->whereIn('negaras.id', $request->id_negara);
        });
    }

    $data = $query->with('negara', 'tingkat_studi')->get();
    $negara = Negara::all();
    $tingkat_studi = tingkat_studi::all();

    // Redirect to homepage with a not found message if no articles are found
    if ($data->isEmpty()) {
        $message = $isJenisBeasiswaFiltered ? 'No articles found for the selected "Jenis Beasiswa"' : 'No articles found';

        return view('frontend.homepage', [
            'data' => collect(), // Passing an empty collection
            'negara' => $negara,
            'tingkat_studi' => $tingkat_studi,
            'message' => $message
        ]);
    }

    return view('frontend.homepage', [
        'data' => $data,
        'negara' => $negara,
        'tingkat_studi' => $tingkat_studi
    ]);
}
}