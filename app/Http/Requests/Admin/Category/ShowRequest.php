<?php
/**
 * Eugeny Nosenko 2021
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShowRequest
 * @package Nos\CRUD
 */
class ShowRequest extends FormRequest
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
        ];
    }
}
