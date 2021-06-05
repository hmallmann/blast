<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 * @package App\Models
 *
 * @property integer id
 * @property integer user_id
 * @property string  name
 * @property string  document
 * @property integer status
 */
class Customer extends Model
{
    use SoftDeletes;

    protected $table = 'customers';

    protected $fillable = ['id'];

    static $statusList = [1 => 'New',
                          2 => 'Active',
                          3 => 'Suspended',
                          4 => 'Cancelled'];

    public function getStatus()
    {
        return self::$statusList[$this->status];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->first();
    }

    public static function getStatusList()
    {
        $statusListCombo = array();

        foreach ( self::$statusList as $id => $value)
        {
            $status = new \stdClass();
            $status->id = $id;
            $status->title = $value;
            $statusListCombo[] = $status;
        }

        return $statusListCombo;
    }

    public static function getCustomersList()
    {
        return self::select('id', 'name AS title')->get();
    }
}
