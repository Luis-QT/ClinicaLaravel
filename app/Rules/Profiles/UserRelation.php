<?php

namespace App\Rules\Profiles;

use Illuminate\Contracts\Validation\Rule;
use App\Profile;

class UserRelation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $profile = Profile::find($value);
        if($profile->users->isNotEmpty()){
            return false;
        }else{
            return true;
        }

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No se pudo eliminar, el perfil tiene relacion con usuarios';
    }
}
