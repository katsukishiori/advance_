<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date' => ['required', 'after:today'],
            'time' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'date' => '日付は必ず選択してください。',
            'date.after' => '現在の日時よりも後の日時を選択してください。',
            'time' => '時間は必ず選択してください。',
        ];
    }
}
