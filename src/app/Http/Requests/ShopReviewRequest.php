<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopReviewRequest extends FormRequest
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
            'stars' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:200'
        ];
    }

    public function messages()
    {
        return [
            'stars.required' => '評価は必須です。',
            'stars.integer' => '評価は整数でなければなりません。',
            'stars.min' => '評価は1以上でなければなりません。',
            'stars.max' => '評価は5以下でなければなりません。',
            'comment.required' => 'コメントは必須です。',
            'comment.string' => 'コメントは文字列でなければなりません。',
            'comment.max' => 'コメントは200文字以内でなければなりません。',
        ];
    }
}
