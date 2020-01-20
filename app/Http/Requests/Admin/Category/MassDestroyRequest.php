<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class MassDestroyRequest
 * @package CodersStudio\CRUD
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
            'selected.*' => 'exists:categories,id',
        ];
    }
}
