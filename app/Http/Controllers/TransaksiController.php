<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Produk;
use App\Http\Resources\TransaksiResource;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    // Tambah Transaksi
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'produk_id' => 'required|exists:produks,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $produk = Produk::find($request->produk_id);
        $harga_total = $produk->harga * $request->jumlah;

        $transaksi = Transaksi::create([
            'produk_id' => $request->produk_id,
            'jumlah' => $request->jumlah,
            'harga_total' => $harga_total,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        return new TransaksiResource($transaksi);
    }

    // Riwayat Transaksi
    public function index()
    {
        $transaksis = Transaksi::with('produk')->get();
        return TransaksiResource::collection($transaksis);
    }

    // Detail Transaksi
    public function show($id)
    {
        $transaksi = Transaksi::with('produk')->findOrFail($id);
        return new TransaksiResource($transaksi);
    }

    // Pembatalan Transaksi
    public function cancel($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        if ($transaksi->status === 'selesai') {
            $transaksi->update(['status' => 'dibatalkan']);
            return new TransaksiResource($transaksi);
        }
        return response()->json(['message' => 'Transaksi sudah dibatalkan sebelumnya'], 400);
    }
}