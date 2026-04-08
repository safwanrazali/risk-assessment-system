<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriPuncaRisikoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('kategori_punca_risiko')?->id;
        return [
            'nama' => 'required|string|max:255|unique:kategori_punca_risikos,nama'.($id ? ',' . $id : ''),
        ];
    }
}
