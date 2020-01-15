<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use CodersStudio\CRUD\Traits\Crudable;

class Post extends Model
{
    use Crudable;

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
                            ];

    protected $fillable = [
                            'name',
                            'slug',
                            'publish',
                            'preview_text',
                            'detail_text',
                            ];

    protected $hidden = [
                            ];

    

    
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
     * Scope for filtering by slug
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfSlug($query,$value)
    {
        return $query->where('slug','like','%'.$value.'%');
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
