<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmploiStoreRequest extends FormRequest
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
            'classe_id' => ['required', 'exists:classes,id'],
            'salle_id' => ['required', 'exists:salles,id'],
            'user_id' => ['required', 'exists:users,id'],
            'Ddebut' => ['required', 'max:255', 'string'],
            'Dfin' => ['required', 'max:255', 'string'],
            'prof_id' => ['required', 'exists:profs,id'],
        ];
    }
}
