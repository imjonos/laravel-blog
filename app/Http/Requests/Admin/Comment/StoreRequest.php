<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Comment;

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
            'user_name' => 'required|string',
            'publish' => 'required|boolean',
            'comment' => 'required|string',
            'post_id' => 'required|integer',
        ];
    }
}
