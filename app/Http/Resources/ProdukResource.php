<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_produk' => $this->nama_produk,
            'harga' => $this->harga,
            'stok' => $this->stok,
            'stok_minimum' => $this->stok_minimum,
            'status_stok' => $this->stok <= $this->stok_minimum ? 'stok rendah' : 'stok aman'
        ];
    }
}