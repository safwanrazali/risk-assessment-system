<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('pengguna')?->id;
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email'.($id ? ',' . $id : ''),
            'password' => $id ? 'nullable|string|min:8' : 'required|string|min:8',
            'peranan' => 'required|in:admin,agensi',
            'agensi_id' => 'nullable|exists:agensis,id',
        ];
    }
}
