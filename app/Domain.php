<?php

namespace App;

use App\Traits\SetGetDomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Domain extends Model
{
    use SoftDeletes, HasTranslations, SetGetDomain;

    public $translatable = ['info'];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at', 'updated_at',
    ];

    /**
     * Get the inquiries for the domain.
     */
    public function inquiries()
    {
        return $this->hasMany('App\Inquiry');
    }

    /**
     * Get the visits for the domain.
     */
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * Get the visits for the domain.
     */
    public function dailyVisits()
    {
        return $this->hasMany('App\DailyVisit');
    }

    /**
     * Get the visits per day record associated with the user.
     */
    public function visitsPerDay()
    {
        return $this->hasOne('App\VisitsPerDay');
    }
}
