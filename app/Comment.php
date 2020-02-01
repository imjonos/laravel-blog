<?php
/**
 * CodersStudio 2019
 * https://coders.studio
 * info@coders.studio
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use CodersStudio\CRUD\Traits\Crudable;

class Comment extends Model
{
    use Crudable;

   /**
     * Columns available for sorting
     * @var array
     */
    protected $sortable = [
                            'id',
                            'user_name',
                            'publish',
                            'comment',
                            'post_id',
                            ];

    protected $fillable = [
                            'user_name',
                            'publish',
                            'comment',
                            'post_id',
                            ];

    protected $hidden = [
                            ];

    
    /**
    * Get the post record associated with the Comment.
    */
    public function post()
    {
        return $this->belongsTo('App\Post');
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
     * Scope for filtering by user_name
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfUserName($query,$value)
    {
        return $query->where('user_name','like','%'.$value.'%');
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
     * Scope for filtering by comment
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfComment($query,$value)
    {
        return $query->where('comment','like','%'.$value.'%');
    }


    /**
     * Scope for filtering by post_id
     * @param $query
     * @param $value
     * @return mixed
     */
    public function scopeOfPostId($query,$value)
    {
        return $query->where('post_id','=',$value);
    }



}
