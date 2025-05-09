<?php

namespace App\Http\Requests\Matches;

use Illuminate\Foundation\Http\FormRequest;

class StoreDartsMatchRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'player_1_id' => ['required', 'exists:players,id', 'different:player_2_id'],
            'player_2_id' => ['required', 'exists:players,id', 'different:player_1_id'],
        ];
    }
}
