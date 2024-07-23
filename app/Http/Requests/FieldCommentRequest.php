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
            'comment' => 'required|string|max:1000',
        ];
    }
}
