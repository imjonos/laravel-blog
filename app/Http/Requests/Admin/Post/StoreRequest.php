<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Post;

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
            'category_id' => 'required|numeric',
            'slug' => 'required|unique:posts,slug|string',
            'publish' => 'boolean',
            'preview_text' => 'required|string',
            'detail_text' => 'required|string',
        ];
    }
}
