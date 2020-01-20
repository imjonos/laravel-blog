<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use CodersStudio\CRUD\Traits\Crudable;
use CodersStudio\CRUD\Traits\Multitenantable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Post extends Model implements HasMedia
{
    use Crudable, Multitenantable, HasMediaTrait;

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
                            'category_id'
                            ];

    protected $fillable = [
                            'name',
                            'slug',
                            'publish',
                            'preview_text',
                            'detail_text',
                            'category_id'
                            ];

    protected $hidden = [];

    protected $appends = ['media_collection'];

    /**
     * Return files
     * @return Array
     */
    public function getMediaCollectionAttribute():array
    {
        $this->getMedia();
        return [
            "name" => "PostMediaCollection",
            "files" => $this->media,
            "removedFiles" => []
        ];
    }

    /**
     * Category
     */
    public function category()
    {
        return $this->belongsTo("App\Category");
    }

    /**
     * Scope for filtering by id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfId($query,$value)
    {
        return $query->where('id','=',$value);
    }


    /**
     * Scope for filtering by name
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfName($query,$value)
    {
        return $query->where('name','like','%'.$value.'%');
    }

    /**
     * Scope a query to only include published posts.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
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
    public function scopeOfSlug($query,$value)
    {
        return $query->where('slug','=', $value);
    }

    /**
     * Scope for filtering by category
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfCategoryId($query, $value)
    {
        return $query->where('category_id','=', $value);
    }

    /**
     * Scope for filtering by publish
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfPublish($query,$value)
    {
        return $query->where('publish','=',$value);
    }


    /**
     * Scope for filtering by preview_text
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfPreviewText($query,$value)
    {
        return $query->where('preview_text','like','%'.$value.'%');
    }


    /**
     * Scope for filtering by detail_text
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfDetailText($query,$value)
    {
        return $query->where('detail_text','like','%'.$value.'%');
    }



}
