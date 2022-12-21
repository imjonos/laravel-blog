<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyRequest
 * @package Nos\CRUD
 */
class MassDestroyRequest extends FormRequest
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
            'selected.*' => 'exists:comments,id',
        ];
    }
}
