<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest
 * @package CodersStudio\CRUD
 */
class StoreRequest extends FormRequest
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
            'name' => 'required|string',
            'slug' => 'required|unique:categories,slug|string',
            'publish' => 'required|boolean',
        ];
    }
}
