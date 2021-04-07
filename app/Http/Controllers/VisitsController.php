<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class VisitsController extends Controller
{
    public function __construct()
    {
        $this->return_array['sidebar'] = 'Aufrufe IP';
    }

    public function getFilterModal()
    {
        $return_array['ModalTitle'] = 'Filter Aufrufe IP';
        return (string)view('visits-admin.filter-modal')->with($return_array);
    }

    public function index()
    {
        $this->return_array['page_length'] = 25;
        $this->return_array['columns'] = array(
            'created_at' => array(
                'name' => 'Erstellt AM',
                'sort' => true,
            ),
            'domains.domain' => array(
                'name' => 'Domain',
                'sort' => true,
            ),
            'ip' => array(
                'name' => 'IP',
                'sort' => true,
            ),
        );
        return view('visits-admin.index')->with($this->return_array);
    }

    public function getAllVisitsJson()
    {
        return DataTables::of(\App\Visit::select('domains.domain','visits.*')->join('domains', 'domains.id', '=', 'visits.domain_id'))
            ->editColumn('created_at', function ($visits) {
                return $visits->created_at;
            })
            ->editColumn('domains.domain', function ($visits) {
                return $visits->domain;
            })
            ->editColumn('ip', function ($visits) {
                return $visits->ip;
            })
            ->rawColumns([
                'created_at',
                'domains.domain',
                'ip',
            ])->make(true);
    }
}
