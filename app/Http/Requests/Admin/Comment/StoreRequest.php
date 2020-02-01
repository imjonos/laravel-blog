<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Comment;

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
            'user_name' => 'required|string',
            'publish' => 'required|boolean',
            'comment' => 'required|string',
            'post_id' => 'required|string',
        ];
    }
}
