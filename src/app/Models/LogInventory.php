<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Banners
 * @package App\Models
 *
 * @property $service_name
 * @property $log_time
 * @property $verb
 * @property $url
 * @property $protocol
 * @property $status
 */
class LogInventory extends Model
{
    use HasFactory;
    public $dates = [
        'log_date',
    ];

    protected $fillable = [
        'service_name',
        'log_time',
        'verb',
        'url',
        'protocol',
        'status'
    ];

}
