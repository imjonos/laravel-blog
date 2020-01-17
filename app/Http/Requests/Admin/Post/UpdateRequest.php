<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Admin\Post;

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
            'name' => 'sometimes|string',
            'slug' => 'sometimes|unique:posts,slug,' . $this->id .'|string',
            'publish' => 'boolean',
            'preview_text' => 'sometimes|string',
            'detail_text' => 'sometimes|string',
        ];
    }
}
