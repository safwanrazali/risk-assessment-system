<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DaftarRisikoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'agensi_id' => 'required|exists:agensis,id',
            'aset_id' => 'required|exists:asets,id',
            'kategori_id' => 'required|exists:kategori_risikos,id',
            'sub_kategori_id' => 'required|exists:sub_kategori_risikos,id',
            'risiko_id' => 'required|exists:risikos,id',
            'kategori_punca_risiko_id' => 'required|exists:kategori_punca_risikos,id',
            'punca_risiko_id' => 'required|exists:punca_risikos,id',
            'impak' => 'required|integer|min:1|max:5',
            'kebarangkalian' => 'required|integer|min:1|max:5',
            'skor_risiko' => 'nullable|integer',
            'tahap_risiko' => 'nullable|string|max:255',
            'kawalan_sedia_ada' => 'nullable|string',
            'pelan_mitigasi' => 'nullable|string',
            'pemilik_risiko' => 'nullable|string|max:255',
        ];
    }
}
