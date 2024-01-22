<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVideoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required',
            'video' => 'required|mimes:mp4',
            'category_id' => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Не скудно ли без названия',
            'video.required' => 'То есть ты добавляешь видео без видео?',
            'video.mimes' => 'Меня не обманешь',
            'category_id.required' => 'Да блин, неудобно без категории',
        ];
    }
}
