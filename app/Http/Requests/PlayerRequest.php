<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlayerRequest extends FormRequest
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
            'team_id' => 'required',
            'first_name' => 'required|max:191',
            'last_name' => 'required|max:191',
            'jersey_number' => 'required|numeric|digits_between:1,5',
            'country' => 'required|max:191',
            'matches' => 'required|max:191|digits_between:1,5',
            'runs' => 'nullable|max:191|digits_between:1,10',
            'highest_score' => 'nullable|max:191|digits_between:1,5',
            'total_fifties' => 'nullable|max:191|digits_between:1,5',
            'total_hundreds' => 'nullable|max:191|digits_between:1,5',
            'image' => $image_required.'|image|max:2999|mimes:jpeg,jpg,png,gif',
        ];
    }
}
