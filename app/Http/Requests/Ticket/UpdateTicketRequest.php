<?php

namespace App\Http\Requests\Ticket;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketRequest extends FormRequest
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
            'status' => 'required|in:new,in_work,done'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'Поле является обязательным',
            'status.in' => 'Недопустимый статус'
        ];
    }
}
