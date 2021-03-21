<?php

namespace App;

use App\Traits\SetGetDomain;
use Illuminate\Database\Eloquent\Model;

class NotFoundDomain extends Model
{
    use SetGetDomain;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at', 'updated_at',
    ];
}
