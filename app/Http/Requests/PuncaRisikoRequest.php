<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PuncaRisikoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_punca_risiko_id' => 'required|exists:kategori_punca_risikos,id',
            'nama' => 'required|string|max:255',
        ];
    }
}
