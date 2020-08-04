<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TeamRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $image_required = $this->route('team') ? "nullable" : "required";

        return [
            'name' => 'required|max:191|unique:teams',
            'club_state' => 'required|max:191',
            'logo' => $image_required.'|image|max:2999|mimes:jpeg,jpg,png,gif',
        ];
    }
}
