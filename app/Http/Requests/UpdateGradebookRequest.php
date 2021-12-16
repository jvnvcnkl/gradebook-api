<?php

namespace App\Http\Requests;

use App\Models\Gradebook;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGradebookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return Gradebook::findOrFail($id)->user_id == Auth::id();
       // $id = $this->route('id');
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
            'name' => 'min:2|max:255'
        ];
    }
}
