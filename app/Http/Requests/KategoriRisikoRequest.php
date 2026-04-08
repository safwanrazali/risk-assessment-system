<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KategoriRisikoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('kategori_risiko')?->id;
        return [
            'nama' => 'required|string|max:255|unique:kategori_risikos,nama'.($id ? ',' . $id : ''),
        ];
    }
}
