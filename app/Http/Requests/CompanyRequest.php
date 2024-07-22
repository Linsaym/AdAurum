<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        # TODO Возможно имеет смысл сделать так, чтобы компании могли создавать только админы
        # В данный момент из за структуры интерфейса, нельзя создавать новые компании
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'inn' => 'required|string|max:12',
            'general_info' => 'nullable|string',
            'ceo' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ];
    }
}
