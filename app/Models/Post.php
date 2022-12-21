<?php
/**
 * Eugeny Nosenko 2022
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Nos\CRUD\Traits\Crudable;
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
 * @property string $created_at
 * @property string $updated_at
 */
final class Post extends Model implements HasMedia
{
    use Crudable;
    use HasFactory;
    use HasMediaTrait;

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
        'user_id',
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
    public function scopeOfPublish(Builder $query, string $value): Builder
    {
        return $query->where('publish', '=', $value);
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

    /**
     * Get image path
     * @return string
     */
    public function getImageAttribute(): string
    {
        $image = $this->media()->orderBy('id', 'DESC')->first();
        $path = "http://placehold.it/900x300";
        if (isset($image->file_name)) {
            $path = '/storage/' . $image->id . '/' . $image->file_name;
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
