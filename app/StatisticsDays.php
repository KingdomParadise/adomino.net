<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticsDays extends Model
{
    protected $table = "statistics_day_summary";
    protected $fillable = ['visit_per_days_id', 'total_visit', 'day'];

    public static function getAllGroupedDays()
    {
        return StatisticsDays::select('day')->groupBy('day')->orderBy('day','desc')->get();
    }

    public function statistic()
    {
        return $this->hasMany('App\statistic');
    }
}
