<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisingCampaignRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'from' => [
                'required',
                'date'
            ],
            'to' => [
                'required',
                'date'
            ],
            'total' => [
                'required',
                'int'
            ],
            'daily_budget' => [
                'required',
                'int'
            ],
            'images' => [
                'nullable',
            ]
        ];
    }
}
