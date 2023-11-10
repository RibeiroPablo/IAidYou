<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AskingHelpRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'user_request_id' => 'required|integer',
            'category_id' => 'required|integer',
        ];
    }
}
