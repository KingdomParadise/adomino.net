<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class NotFoundController extends Controller
{
    public function __construct()
    {
        $this->return_array['sidebar'] = 'Fehler-Domains';
    }

    public function getFilterNfDomainModal()
    {
        $return_array['ModalTitle'] = 'Filter Not Found Domain';
        return (string)view('not-found-domain-admin.filter-modal')->with($return_array);
    }

    public function deleteNotFoundDomainProcess(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        \App\NotFoundDomain::deleteDomain($request->id);
        return redirect()->back()->with('message', __('admin-nfdomain.deleteDomainSuccessMessage'));
    }

    public function getDeleteNotFoundDomainModal(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $return_array['ModalTitle'] = 'Domain löschen';
        $return_array['id'] = $request->id;
        return (string)view('not-found-domain-admin.delete-domain-modal')->with($return_array);
    }

    public function editDomain($id)
    {
        if (!is_numeric($id) || empty($id)) {
            dd('id not found');
        }
        $this->return_array['domain'] = \App\NotFoundDomain::getDomain($id);
        return view('not-found-domain-admin.new-domain')->with($this->return_array);
    }

    public function addDomainProcess(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
        ]);
        $requestArray = $request->except(['_token']);
        \App\NotFoundDomain::saveDomain($requestArray);
        return redirect()->back()->with('message', __('admin-nfdomain.createDomainSuccess'));
    }

    public function updateDomainProcess(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
            'id' => 'required',
        ]);
        $requestArray = $request->except(['_token']);
        \App\NotFoundDomain::saveDomain($requestArray);
        return redirect()->back()->with('message', __('admin-nfdomain.updateDomainSuccess'));
    }

    public function addNewDomain()
    {
        return view('not-found-domain-admin.new-domain')->with($this->return_array);
    }

    public function getAllDomainsJson()
    {
        return DataTables::of(\App\NotFoundDomain::all())
            ->addColumn('checkbox', function ($domain) {
                return '<input type="checkbox" data-row-id="' . $domain->id . '" class="selectCheckBox"/>';
            })
            ->editColumn('id', function ($domain) {
                return $domain->id;
            })
            ->editColumn('created_at', function ($domain) {
                return $domain->created_at;
            })
            ->editColumn('domain', function ($domain) {
                return $domain->domain;
            })
            ->addColumn('actions', function ($domain) {
                return '
                <a href="' . route('edit-nf-domain', [$domain->id]) . '"
                style="cursor: pointer;color: black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                <label data-href="' . route('get-delete-nfdomain-modal') . '"
                data-id="' . $domain->id . '"
                data-name="get-delete-inquiry-modal" style="cursor: pointer" class="OpenModal"><i class="fa fa-trash"></i></label>';
            })
            ->rawColumns([
                'checkbox',
                'id',
                'created_at',
                'domain',
                'actions',
            ])->make(true);
    }

    public function index()
    {
        $this->return_array['page_length'] = 10;
        $this->return_array['columns'] = array(
            'checkbox' => array(
                'name' => '<input type="checkbox" id="selectAllCheckbox"/>',
                'sort' => false,
            ),
            'id' => array(
                'name' => 'ID',
                'sort' => true,
            ),
            'created_at' => array(
                'name' => 'Uhrzeit',
                'sort' => false,
            ),
            'domain' => array(
                'name' => 'Domain',
                'sort' => false,
            ),
            'actions' => array(
                'name' => 'Actions',
                'sort' => false,
            ),
        );
        return view('not-found-domain-admin.index')->with($this->return_array);
    }
}
