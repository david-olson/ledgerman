<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\UserRequest;

class ProcessUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $userRequest = UserRequest::find($this->route('userRequest'));

        if ($userRequest && Auth::user->id == $userRequest->reciever->id) {
            return true;
        }

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
            'action' => 'in:accept,reject'
        ];
    }
}
