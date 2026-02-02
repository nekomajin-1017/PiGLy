<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PiglyRequest extends FormRequest
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
        if ($this->has('target_weight') && !$this->hasAny(['date', 'weight', 'calories', 'exercise_time', 'exercise_content'])) {
            return [
                'target_weight' => ['required', 'numeric', 'between:0,9999', 'regex:/^\\d+(\\.\\d)?$/'],
            ];
        }

        if ($this->has(['weight', 'target_weight']) && !$this->hasAny(['date', 'calories', 'exercise_time'])) {
            return [
                'weight' => ['required', 'numeric', 'between:0,9999', 'regex:/^\\d+(\\.\\d)?$/'],
                'target_weight' => ['required', 'numeric', 'between:0,9999', 'regex:/^\\d+(\\.\\d)?$/'],
            ];
        }

        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'between:0,9999', 'regex:/^\\d+(\\.\\d)?$/'],
            'calories' => ['required', 'integer'],
            'exercise_time' => ['required', 'date_format:H:i'],
            'exercise_content' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '日付を正しく入力してください',
            'weight.required' => '体重を入力してください',
            'weight.numeric' => '数字で入力してください',
            'weight.between' => '4桁までの数字で入力してください',
            'weight.regex' => '小数点は1桁で入力してください',
            'calories.required' => '摂取カロリーを入力してください',
            'calories.integer' => '数字で入力してください',
            'exercise_time.required' => '運動時間を入力してください',
            'exercise_time.date_format' => '運動時間を正しく入力してください',
            'exercise_content.max' => '120文字以内で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.numeric' => '数字で入力してください',
            'target_weight.between' => '4桁までの数字で入力してください',
            'target_weight.regex' => '小数点は1桁で入力してください',
        ];
    }
}
