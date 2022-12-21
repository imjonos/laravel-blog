<?php
/**
 * Eugeny Nosenko 2022
 * https://toprogram.ru
 * info@toprogram.ru
 */

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Nos\CRUD\Traits\Crudable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
* @property int $id
* @property string $name
* @property string $slug
* @property bool $publish
* @property string $created_at
* @property string $updated_at
*/
final class Category extends Model
{
    use Crudable;
    use HasFactory;

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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                            'name',
                            'slug',
                            'publish',
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

    

    
    /**
     * Scope for filtering by id
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfId(Builder $query, string $value): Builder
    {
        return $query->where('id','=',$value);
    }

    /**
     * Scope for filtering by name
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfName(Builder $query, string $value): Builder
    {
        return $query->where('name','like','%'.$value.'%');
    }

    /**
     * Scope for filtering by slug
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfSlug(Builder $query, string $value): Builder
    {
        return $query->where('slug','like','%'.$value.'%');
    }

    /**
     * Scope for filtering by publish
     * @param Builder $query
     * @param string $value
     * @return Builder
     */
    public function scopeOfPublish(Builder $query, string $value): Builder
    {
        return $query->where('publish','=',$value);
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
