<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SektorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('sektor')?->id;

        return [
            'nama' => 'required|string|max:255|unique:sektors,nama'.($id ? ',' . $id : ''),
        ];
    }
}
