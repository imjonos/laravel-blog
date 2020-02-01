<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ImportRequest
 * @package CodersStudio\CRUD
 */
class ImportRequest extends FormRequest
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
