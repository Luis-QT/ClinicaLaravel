<?php

namespace App\Http\Requests\Profiles;
use App\Rules\Profiles\UserRelation;

use Illuminate\Foundation\Http\FormRequest;

class Destroy extends FormRequest
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
            'id' => new UserRelation,
        ];
    }
    public function messages()
    {
        return trans('validation.userrelation');
    }
}
