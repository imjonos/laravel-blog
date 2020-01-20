<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 * @package CodersStudio\CRUD
 */
class UpdateRequest extends FormRequest
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
            'name' => 'sometimes|string',
            'slug' => 'sometimes|unique:categories,slug,' . $this->id .'|string',
            'publish' => 'sometimes|boolean',
        ];
    }
}
