<?php

namespace App\Models;

// Required Libraries
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Auditable as AuditableUse;
use OwenIt\Auditing\Contracts\Auditable;

class Address extends Model implements Auditable
{
    use AuditableUse, SoftDeletes;

    /**************************************************************/
    /*************************** CONFIGS **************************/

    protected $table = 'addresses';

    protected $fillable = [
    	'post_code',
    	'route',
    	'neighborhood',
    	'city',
    	'state',
    ];
}
