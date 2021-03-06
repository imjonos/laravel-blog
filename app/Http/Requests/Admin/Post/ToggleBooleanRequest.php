<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ToggleBooleanRequest
 * @package CodersStudio\CRUD
 */
class ToggleBooleanRequest extends FormRequest
{
    /**
     * authorize
     */
    public function authorize()
    {
        return true;
    }

    /**
    * rules
    */
    public function rules()
    {
        return [
            'value' => 'required|boolean',
            'column_name' => 'required|string',
        ];
    }
}
