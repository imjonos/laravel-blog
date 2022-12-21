<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Comment;

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
            'user_name' => 'sometimes|string',
            'publish' => 'sometimes|boolean',
            'comment' => 'sometimes|string',
            'post_id' => 'sometimes|integer',
        ];
    }
}
