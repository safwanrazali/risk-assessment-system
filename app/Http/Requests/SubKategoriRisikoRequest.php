<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubKategoriRisikoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategori_risikos,id',
            'nama' => 'required|string|max:255',
        ];
    }
}
