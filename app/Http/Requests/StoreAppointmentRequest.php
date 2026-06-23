<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_name'        => 'required|string|max:255',
            'service_name'         => 'required|string|max:255',
            'appointment_datetime' => 'required|date_format:Y-m-d H:i:s'
        ];
    }


    public function attributes(): array
    {
        return [
            'customer_name' => 'nome do cliente',
            'service_name' => 'nome do serviço',
            'appointment_datetime' => 'data e hora do agendamento'
        ];
    }
}
