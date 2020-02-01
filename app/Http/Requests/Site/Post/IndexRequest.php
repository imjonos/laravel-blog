<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Site\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class IndexRequest
 * @package CodersStudio\CRUD
 */
class IndexRequest extends FormRequest
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
            'search' => 'string'
        ];
    }
}
