<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'field_id' => 'required|exists:company_fields,id',
            'comment' => 'required|string|max:1000',
        ];
    }
}
