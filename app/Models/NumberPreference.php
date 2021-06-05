<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


/**
 * Class NumberPreference
 * @package App\Models
 *
 * @property int    number_id
 * @property string name
 * @property string value

 */
class NumberPreference extends Model
{
    use SoftDeletes;

    protected $table = 'number_preferences';

    protected $fillable = ['id'];

    public function number()
    {
        return $this->belongsTo(Number::class, 'number_id', 'id')->first();
    }
}
