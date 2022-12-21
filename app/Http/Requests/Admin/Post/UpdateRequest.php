<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 * @package Nos\CRUD
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
            'slug' => 'sometimes|unique:posts,slug,' . $this->id .'|string',
            'publish' => 'sometimes|boolean',
            'preview_text' => 'sometimes|string',
            'detail_text' => 'sometimes|string',
            'category_id' => 'sometimes|integer',
            'user_id' => 'sometimes|integer',
        ];
    }
}
