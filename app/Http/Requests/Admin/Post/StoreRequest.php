<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreRequest
 * @package Nos\CRUD
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
            'slug' => 'required|unique:posts,slug|string',
            'publish' => 'required|boolean',
            'preview_text' => 'required|string',
            'detail_text' => 'required|string',
            'category_id' => 'required|integer',
            'user_id' => 'required|integer',
        ];
    }
}
