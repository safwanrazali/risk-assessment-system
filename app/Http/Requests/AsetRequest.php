<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsetRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'agensi_id' => 'required|exists:agensis,id',
            'jenis_aset_id' => 'required|exists:jenis_asets,id',
            'nama_aset' => 'required|string|max:255',
        ];
    }
}
