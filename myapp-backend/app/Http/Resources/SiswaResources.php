<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SiswaResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nama_depan' => $this->nama_depan,
            'nama_belakang' => $this->nama_belakang,
            'alamat' => $this->alamat,
            'telp' => $this->telp,
            'kelas' => $this->kelas,
            'jk' => $this->jk,
            'status' => $this->status,
        ];
    }
}
