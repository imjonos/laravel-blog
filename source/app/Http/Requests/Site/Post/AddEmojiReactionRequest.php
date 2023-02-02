<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App\Http\Requests\Site\Post;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ShowRequest
 * @package CodersStudio\CRUD
 */
final class AddEmojiReactionRequest extends FormRequest
{
    /**
     * authorize
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * rules
     */
    public function rules(): array
    {
        return [
            'emoji_id' => 'required|integer'
        ];
    }
}
