<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
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
            'customer_name' => 'required|string|max:50',
            'customer_phone' => 'required|regex:/^\+[1-9]\d{7,14}$/',
            'customer_email' => 'nullable|email|max:100',
            'subject' => 'required|string|max:255',
            'text' => 'required|string|max:2000',
            'file' => 'nullable|file|max:5000'
        ];
    }

    public function messages()
    {
        return [
            'customer_name.required' => 'Поле имя является обязательным',
            'customer_name.string' => 'Поле имя должно быть строкой',
            'customer_name.max' => 'Максимум 50 символов',
            'customer_email.email' => 'Введите ваш email',
            'customer_email.max' => 'Максимум 100 символов',
            'customer_phone.required' => 'Поле телефон является обязательным',
            'customer_phone.regex' => 'Телефон должен быть в формате "+380959999999"',
            'subject.required' => 'Поле темы является обязательным',
            'subject.string' => 'Поле темы должно быть строкой',
            'subject.max' => 'Максимум 255 символов',
            'text.required' => 'Поле текст является обязательным',
            'text.string' => 'Поле текст должно быть строкой',
            'text.max' => 'Максимум 2000 символов',
            'file.file' => 'Это должен быть файл',
            'file.max' => 'Максимальный размер 5мб'

        ];
    }
}
