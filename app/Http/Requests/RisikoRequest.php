<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RisikoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sub_kategori_risiko_id' => 'required|exists:sub_kategori_risikos,id',
            'nama' => 'required|string|max:255',
        ];
    }
}
