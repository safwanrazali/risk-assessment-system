<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgensiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_agensi' => 'required|string|max:255',
            'no_tel_agensi' => 'nullable|string|max:50',
            'website' => 'nullable|url|max:255',
            'nama_pic' => 'nullable|string|max:255',
            'no_tel_pic' => 'nullable|string|max:50',
            'emel_pic' => 'nullable|email|max:255',
            'sektor_id' => 'required|exists:sektors,id',
            'jenis_agensi' => 'nullable|string|max:255',
        ];
    }
}
