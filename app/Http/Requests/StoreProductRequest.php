<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:50',
            'category_id' => 'required',
            'status' => 'required|in:active,inactive,draft',
            'description' => 'required',
            'image' => 'required',
            'weight' => 'required|numeric|max:100000',
            'price' => 'required|numeric|max:1000000000',
        ];
    }
}