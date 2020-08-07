<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatchRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $image_required = $this->route('player') ? "nullable" : "required";
        return [
            'first_team' => 'required',
            'second_team' => 'required|different:first_team',
            'match_date' => 'required',
            'result' => 'required',
            'winner' => 'required_if:result,1',
        ];
    }

    public function messages()
    {
        return [
            "winner.required_if" => "Winner team is required if match is not draw."
        ];
    }
}
