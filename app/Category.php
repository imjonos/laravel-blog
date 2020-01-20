<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use CodersStudio\CRUD\Traits\Crudable;

class Category extends Model
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
                            ];

    protected $fillable = [
                            'name',
                            'slug',
                            'publish',
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
     * Scope a query to only include published categories.
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



}
