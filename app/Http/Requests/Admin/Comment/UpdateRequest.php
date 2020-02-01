<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Comment;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UpdateRequest
 * @package CodersStudio\CRUD
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
            'post_id' => 'sometimes|string',
        ];
    }
}
