<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

class statistic extends Model
{
    protected $table = 'visits_per_days';
    public static $date = null;

    public function domain()
    {
        return $this->belongsTo('App\Domain');
    }

    public static function getStatisticCount($columns, $start_date, $end_date, $statistic)
    {
        $total = 0;
        $totalColumns = 0;
        foreach ($columns as $column) {
            if (strpos($column, "day") !== false) {
                $columnDate = str_replace('day', '', $column);
                if (self::check_in_range($start_date, $end_date, $columnDate, true)) {
                    $total += $statistic->$column;
                    $totalColumns++;
                }
            }
        };
        return [$totalColumns, $total];
    }

    public static function check_in_range($start_date, $end_date, $date_from_user, $debug = false)
    {
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        $check = strtotime($date_from_user);
        return (($start <= $check) && ($check <= $end));
    }

    public static function getContentCount()
    {
        return statistic::count();
    }

    public static function getColumnNames()
    {
        $columns = array_reverse(Schema::getColumnListing('visits_per_days'));
        $columnArray = [
            Number::make('ID')->sortable(),
            BelongsTo::make('Domain'),
            Text::make('Adomino_com_id'),
//            Text::make('Schnitt'),
//            Text::make('Total'),
        ];
        foreach ($columns as $column) {
            if (strpos($column, "day") !== false) {
                array_push($columnArray, Number::make(date('d.m.', strtotime(str_replace('day', '', $column))), $column));
            }
        }
        return $columnArray;
    }

    public function getAdominoComIdAttribute()
    {
        return $this->domain->adomino_com_id ?? 0;
    }

//    public function getDomainAttribute()
//    {
//        return 'test';
//        print_r($this->domain()->domain);
//        die;
//        return "test".$this->domain->domain ?? '';
//    }

//    public function getSchnittAttribute()
//    {
//        return 789;
//    }
//
//    public function getTotalAttribute()
//    {
////        print_r($this);
////        return 456;
//    }

}
