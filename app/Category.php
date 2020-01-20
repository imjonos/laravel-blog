<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use CodersStudio\CRUD\Traits\Crudable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Category extends Model implements HasMedia
{
    use Crudable, HasMediaTrait;

    /**
     * Columns available for sorting
     * @var array
     */
    protected $sortable = [
        'id',
        'name',
        'slug',
        'publish',
    ];

    protected $fillable = [
        'name',
        'slug',
        'publish',
    ];

    protected $hidden = [
    ];

    protected $appends = ['media_collection'];

    /**
     * Return files
     * @return Array
     */
    public function getMediaCollectionAttribute(): array
    {
        $this->getMedia();
        return [
            "name" => "CategoryMediaCollection",
            "files" => $this->media,
            "removedFiles" => []
        ];
    }

    /**
     * Scope for filtering by id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfId($query, $value)
    {
        return $query->where('id', '=', $value);
    }


    /**
     * Scope for filtering by name
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfName($query, $value)
    {
        return $query->where('name', 'like', '%' . $value . '%');
    }

    /**
     * Scope a query to only include published categories.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublish($query)
    {
        return $query->where('publish', 1);
    }

    /**
     * Scope for filtering by slug
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfSlug($query, $value)
    {
        return $query->where('slug', 'like', '%' . $value . '%');
    }


    /**
     * Scope for filtering by publish
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfPublish($query, $value)
    {
        return $query->where('publish', '=', $value);
    }


}
