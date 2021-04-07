<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use DataTables;

class StatisticController extends Controller
{
    public function __construct()
    {
        set_time_limit(0);
        $this->return_array['sidebar'] = 'STATISTIK';
        $this->defaultDays = '-10 days';
    }

    public function getFilterStatisticModal()
    {
        $return_array['ModalTitle'] = __('admin-statistics.filterDomainModalTitle');
        return (string)view('statistics-admin.filter-modal')->with($return_array);
    }

    public function index()
    {
//        $this->return_array['page_length'] = 25;
        $this->return_array['page_length'] = -1;
        $this->return_array['columns'] = array(
            'id' => array(
                'name' => '#',
                'sort' => true,
            ),
            'domains.adomino_com_id' => array(
                'name' => 'ID',
                'sort' => false,
            ),
            'domains.domain' => array(
                'name' => 'Domain',
                'sort' => false,
            ),
            'schnitt' => array(
                'name' => 'Schnitt',
                'sort' => false,
            ),
            'total' => array(
                'name' => 'Total',
                'sort' => false,
            )
        );
        if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date']) && !empty($_REQUEST['from_date']) && !empty($_REQUEST['to_date']) && $_REQUEST['from_date'] != 'null' && $_REQUEST['to_date'] != 'null') {
            $start_date = date('y-m-d', strtotime($_REQUEST['from_date']));
            $end_date = date('y-m-d', strtotime($_REQUEST['to_date']));
        } else {
            $start_date = date('y-m-d', strtotime($this->defaultDays));
            $end_date = date('y-m-d', strtotime('-1 day'));
        }
        $columns = Schema::getColumnListing('visits_per_days');
        $dateColumns = array();
        foreach ($columns as $column) {
            if (strpos($column, "day") !== false) {
                $columnDate = str_replace('day', '', $column);
                if ($this->check_in_range($start_date, $end_date, $columnDate)) {
                    $dateColumns[strtotime($columnDate)] = $column;
                }
            }
        }
        krsort($dateColumns);
        foreach ($dateColumns as $dateColumn) {
            $date = date('d.m.', strtotime(str_replace('day', '', $dateColumn)));
            $this->return_array['columns'][$dateColumn] = array(
                'name' => $date,
                'sort' => false,
            );
        }
        return view('statistics-admin.index')->with($this->return_array);
    }

    public function check_in_range($start_date, $end_date, $date_from_user)
    {
        $start = strtotime($start_date);
        $end = strtotime($end_date);
        $check = strtotime($date_from_user);
        return (($start <= $check) && ($check <= $end));
    }

    public function getAllStatisticsJson()
    {
        $query = \App\statistic::select('visits_per_days.*', 'domains.domain as domain_name', 'domains.adomino_com_id as adominId')->join('domains', 'domains.id', '=', 'visits_per_days.domain_id');
        $from_date = "";
        $to_date = "";
        if (isset($_REQUEST['filter'])) {
            $filter = json_decode($_REQUEST['filter'], true);
            if (isset($filter['from_date']) && isset($filter['to_date']) && !empty($filter['from_date']) && !empty($filter['to_date']) && $filter['from_date'] != 'null' && $filter['to_date'] != 'null') {
                $from_date = $filter['from_date'];
                $to_date = $filter['to_date'];
            }
        }
        if (!empty($from_date) && !empty($to_date)) {
            $start_date = date('y-m-d', strtotime($from_date));
            $end_date = date('y-m-d', strtotime($to_date));
        } else {
            $start_date = date('y-m-d', strtotime($this->defaultDays));
            $end_date = date('y-m-d', strtotime('-1 day'));
        }
        //$columns = array_reverse(Schema::getColumnListing('visits_per_days'));
        $columns = Schema::getColumnListing('visits_per_days');
        $dataTableObject = DataTables::of($query)
            ->editColumn('id', function ($statistic) {
                return $statistic->id;
            })
            ->editColumn('domains.domain', function ($statistic) {
                return \App\Domain::displayDomain($statistic->domain_name, $statistic->domain_id);
            })
            ->editColumn('domains.adomino_com_id', function ($statistic) {
                return $statistic->adominId;
            })
            ->addColumn('schnitt', function ($statistic) use ($columns, $start_date, $end_date) {
                try {
                    $statisticDetails = $this->getStatisticCount($columns, $start_date, $end_date, $statistic);
                    return number_format(($statisticDetails[1] / $statisticDetails[0]), 2, '.', ',');
                } catch (\Exception $exception) {
                    return 0;
                }
            })
            ->addColumn('total', function ($statistic) use ($columns, $start_date, $end_date) {
                $statisticDetails = $this->getStatisticCount($columns, $start_date, $end_date, $statistic);
                return $statisticDetails[1];
            });
        $dateColumns = array();
        foreach ($columns as $column) {
            if (strpos($column, "day") !== false) {
                $columnDate = str_replace('day', '', $column);
                if ($this->check_in_range($start_date, $end_date, $columnDate)) {
                    $dateColumns[strtotime($columnDate)] = $column;
                }
            }
        }
        krsort($dateColumns);
        foreach ($dateColumns as $dateColumn) {
            $dataTableObject->addColumn($dateColumn, function ($statistic) use ($dateColumn) {
                return $statistic->$dateColumn;
            });
        }
        return $dataTableObject->rawColumns([
            'domains.domain'
        ])->make(true);
    }

    public function getStatisticCount($columns, $start_date, $end_date, $statistic)
    {
        $total = 0;
        $totalColumns = 0;
        foreach ($columns as $column) {
            if (strpos($column, "day") !== false) {
                $columnDate = str_replace('day', '', $column);
                if ($this->check_in_range($start_date, $end_date, $columnDate)) {
                    $total += $statistic->$column;
                    $totalColumns++;
                }
            }
        };
        return [$totalColumns, $total];
    }
}
