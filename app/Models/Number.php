<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

/**
 * Class Number
 * @package App\Models
 *
 * @property integer id
 * @property integer customer_id
 * @property string  number
 * @property integer status
 */
class Number extends Model
{
    use SoftDeletes;

    protected $table = 'numbers';

    protected $fillable = ['id'];

    static $statusList = [1 => 'Active',
                          2 => 'Inactive',
                          3 => 'Cancelled'];

    public function getStatus()
    {
        return self::$statusList[$this->status];
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

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id')->first();
    }

    public function create()
    {
        $result = $this->save();

        $preference = new NumberPreference();
        $preference->number_id = $this->id;
        $preference->name = 'auto_attendant';
        $preference->value = '1';
        $preference->save();

        $preference = new NumberPreference();
        $preference->number_id = $this->id;
        $preference->name = 'voicemail_enabled';
        $preference->value = '1';
        $preference->save();

        return $result;
    }

    public static function getNumbersList()
    {
        return DB::table('numbers')
                        ->join('customers', 'numbers.customer_id', '=', 'customers.id')
                        ->selectRaw("numbers.id, CONCAT(numbers.number, ' - ', ( SELECT name FROM customers WHERE id = numbers.customer_id)) AS title")->get();
    }
}
