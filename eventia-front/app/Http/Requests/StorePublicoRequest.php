<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePublicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'comunidad_autonoma' => 'required|string',
            'localidad' => 'required|string',
            'provincia' => 'required|string',
            'gustos_musicales' => 'required|string',
            'tipo_eventos_favoritos' => 'required|string',
            'notificaciones' => 'sometimes|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'comunidad_autonoma.required' => 'La comunidad autónoma es obligatoria.',
            'localidad.required' => 'La localidad es obligatoria.',
            'provincia.required' => 'La provincia es obligatoria.',
            'gustos_musicales.required' => 'Indícanos tus gustos musicales.',
            'tipo_eventos_favoritos.required' => 'Dinos qué tipo de eventos prefieres.',
        ];
    }
}
