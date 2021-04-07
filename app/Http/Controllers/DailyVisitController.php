<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class DailyVisitController extends Controller
{
    public function __construct()
    {
        $this->return_array['sidebar'] = 'Aufrufe Tag';
    }

    public function getFilterModal()
    {
        $return_array['ModalTitle'] = 'Filter Aufrufe Tag';
        return (string)view('daily-visit-admin.filter-modal')->with($return_array);
    }

    public function index()
    {
        $this->return_array['page_length'] = 25;
        $this->return_array['columns'] = array(
            'day' => array(
                'name' => 'Day',
                'sort' => true,
            ),
            'domains.domain' => array(
                'name' => 'Domain',
                'sort' => false,
            ),
            'visits' => array(
                'name' => '	Visits_Adomino_net',
                'sort' => false,
            ),
            'adomino_com_total' => array(
                'name' => '	Visits_Adomino_com',
                'sort' => false,
            ),
            'adomino_com_ok' => array(
                'name' => 'Adomino_com_OK',
                'sort' => false,
            ),
            'total' => array(
                'name' => 'Visits_Total',
                'sort' => false,
            ),
        );
        return view('daily-visit-admin.index')->with($this->return_array);
    }

    public function getAllDailyVisitJson()
    {
        return DataTables::of(\App\DailyVisit::select('daily_visits.*', 'domains.domain')->join('domains', 'domains.id', '=', 'daily_visits.domain_id'))
            ->editColumn('day', function ($dailyVisit) {
                return date('Y-m-d', strtotime($dailyVisit->day));
            })
            ->editColumn('domains.domain', function ($dailyVisit) {
                return $dailyVisit->domain;
            })
            ->editColumn('visits', function ($dailyVisit) {
                return $dailyVisit->visits;
            })
            ->addColumn('adomino_com_total', function ($dailyVisit) {
                return ($dailyVisit->total - $dailyVisit->visits);
            })
            ->editColumn('adomino_com_ok', function ($dailyVisit) {
                if ($dailyVisit->adomino_com_ok) {
                    return '<i class="fa fa-check-circle" style="font-size: 20px;color: #0cbb0cb3;"></i>';
                } else {
                    return '<i class="fa fa-times-circle" style="font-size: 20px;color: #ff0000b5;"></i>';
                }
            })
            ->editColumn('total', function ($dailyVisit) {
                return $dailyVisit->total;
            })
            ->rawColumns([
                'day',
                'domains.domain',
                'visits',
                'adomino_com_total',
                'adomino_com_ok',
                'total',
            ])->make(true);
    }
}
