<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransaksiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'produk' => new ProdukResource($this->whenLoaded('produk')),  // Menampilkan detail produk yang berhubungan
            'jumlah' => $this->jumlah,
            'harga_total' => $this->harga_total,
            'metode_pembayaran' => $this->metode_pembayaran,
            'waktu_transaksi' => $this->waktu_transaksi,
            'status' => $this->status,
        ];
    }
}