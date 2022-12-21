<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Category;

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
            'slug' => 'required|unique:categories,slug|string',
            'publish' => 'required|boolean',
        ];
    }
}
