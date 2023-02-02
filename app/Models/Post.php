<?php
/**
 * Eugeny Nosenko 2022
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Nos\CRUD\Traits\Crudable;
use Nos\EmojiReaction\Interfaces\Models\EmojiReactionInterface;
use Nos\EmojiReaction\Traits\HasEmojiReactionTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

/**
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property bool $publish
 * @property string $preview_text
 * @property string $detail_text
 * @property int $category_id
 * @property int $user_id
 * @property int $views
 * @property string $image_public_path
 * @property string $image_url
 * @property string $image_path
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Collection $reactionStatistics
 *
 * @method Builder ofSlug(string $slug)
 * @method Builder publish()
 */
final class Post extends Model implements HasMedia, EmojiReactionInterface
{
    use Crudable;
    use Notifiable;
    use HasFactory;
    use HasMediaTrait;
    use HasEmojiReactionTrait;

    /**
     * Columns available for sorting
     * @var array
     */
    protected $sortable = [
        'id',
        'name',
        'slug',
        'publish',
        'preview_text',
        'detail_text',
        'category_id',
        'user_id',
        'views'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'publish',
        'preview_text',
        'detail_text',
        'category_id',
        'views',
        'user_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'Y-m-d H:i:s';

    protected $appends = ['media_collection'];

    /**
     * Get the category record associated with the Post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user record associated with the Post.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope for filtering by id
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfId(Builder $query, string $value): Builder
    {
        return $query->where('id', '=', $value);
    }

    /**
     * Scope for filtering by name
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfName(Builder $query, string $value): Builder
    {
        return $query->where('name', 'like', '%' . $value . '%');
    }

    public function scopeOfText(Builder $query, string $value): Builder
    {
        return $query->where(fn(Builder $builder) => $builder->ofName($value))
            ->orWhere(fn(Builder $builder) => $builder->ofDetailText($value))
            ->orWhere(fn(Builder $builder) => $builder->ofPreviewText($value));
    }

    /**
     * Scope for filtering by slug
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfSlug(Builder $query, string $value): Builder
    {
        return $query->where('slug', 'like', '%' . $value . '%');
    }

    /**
     * Scope for filtering by publish
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfPublish(Builder $query, bool $value): Builder
    {
        return $query->where('publish', $value);
    }

    public function scopePublish(Builder $query): Builder
    {
        return $query->where('publish', true);
    }

    /**
     * Scope for filtering by preview_text
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfPreviewText(Builder $query, string $value): Builder
    {
        return $query->where('preview_text', 'like', '%' . $value . '%');
    }

    /**
     * Scope for filtering by detail_text
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfDetailText(Builder $query, string $value): Builder
    {
        return $query->where('detail_text', 'like', '%' . $value . '%');
    }

    /**
     * Scope for filtering by category_id
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfCategoryId(Builder $query, string $value): Builder
    {
        return $query->where('category_id', '=', $value);
    }

    /**
     * Scope for filtering by user_id
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfUserId(Builder $query, string $value): Builder
    {
        return $query->where('user_id', '=', $value);
    }

    /**
     * Return files
     * @return array
     */
    public function getMediaCollectionAttribute(): array
    {
        $this->getMedia();

        return [
            "name" => "PostMediaCollection",
            "files" => $this->media,
            "removedFiles" => []
        ];
    }

    public function getImagePublicPathAttribute(): string
    {
        $image = $this->media()->orderBy('id', 'DESC')->first();
        $path = '';
        if (isset($image->file_name)) {
            $path = $image->id . '/' . $image->file_name;
        }

        return $path;
    }

    /**
     * Get image public url
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        $imagePublicPath = $this->image_public_path;
        $path = "/images/900x300.png";
        if ($imagePublicPath) {
            $path = '/storage/' . $imagePublicPath;
        }

        return $path;
    }

    public function getImagePathAttribute(): string
    {
        $imagePublicPath = $this->image_public_path;
        $path = public_path() . '/images/900x300.png';
        if ($imagePublicPath) {
            $path = storage_path('app/public') . '/' . $imagePublicPath;
        }

        return $path;
    }


    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param DateTimeInterface $date
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }

}
