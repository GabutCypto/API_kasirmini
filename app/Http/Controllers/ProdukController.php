<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return ProdukResource::collection($produks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'stok_minimum' => 'required|integer',
        ]);

        $produk = Produk::create($request->all());
        return new ProdukResource($produk);
    }

    public function show($id)
    {
        $produk = Produk::findOrFail($id);
        return new ProdukResource($produk);
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|integer',
            'stok_minimum' => 'required|integer',
        ]);

        $produk->update($request->all());
        return new ProdukResource($produk);
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);
        $produk->delete();
        return response()->json(null, 204);
    }
}