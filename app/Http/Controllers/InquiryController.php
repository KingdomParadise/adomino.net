<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class InquiryController extends Controller
{
    public function __construct()
    {
        $this->return_array['sidebar'] = 'Anfragen';
        $this->session_name = "inquiry_table";
    }

    public function getFilterModal()
    {
        $return_array['ModalTitle'] = 'Anfragen Filter';
        return (string)view('inquiry-admin.filter-modal')->with($return_array);
    }

    public function deleteInquiryProcess(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $id_array = explode(',', $request->id);
        foreach ($id_array as $id) {
            \App\Inquiry::deleteInquiry($id);
        }
        return redirect()->back()->with('message', __('admin-inquiry.deleteInquirySuccessMessage'));
    }

    public function getDeleteInquiryModal(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $return_array['ModalTitle'] = 'Anfrage löschen';
        $return_array['id'] = $request->id;
        return (string)view('inquiry-admin.delete-inquiry-modal')->with($return_array);
    }

    public function updateInquiryProcess(Request $request)
    {
        $this->validate($request, [
            'created_at' => 'required',
            'domain' => 'required',
            'gender' => 'required',
            'surname' => 'required',
            'website_language' => 'required',
            'email' => 'required|email',
            'id' => 'required|numeric',
        ]);
        $domainDetails = \App\Domain::findDomainByName($request->domain);
        if (isset($domainDetails->id) && !empty($domainDetails->id)) {
            $requestArray = $request->except(['_token', 'domain']);
            $requestArray['domain_id'] = $domainDetails->id;
            \App\Inquiry::saveInquiry($requestArray);
            return redirect()->back()->with('message', __('admin-inquiry.updateInquirySuccessMessage'));
        } else {
            return redirect()->back()
                ->withInput($request->input())
                ->with('error', 'Ungültiger Domainname');
        }

    }

    public function editInquiry($id)
    {
        if (!is_numeric($id) || empty($id)) {
            dd('id not found');
        }
        $this->return_array['inquiry'] = \App\Inquiry::getInquiry($id);
        $this->return_array['domain'] = '{"id":' . $this->return_array['inquiry']->domain_id . ',"text":' . $this->return_array['inquiry']->domain->domain . '}';
        return view('inquiry-admin.new-inquiry')->with($this->return_array);
    }

    public function anonymousInquiryProcess(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $id_array = explode(',', $request->id);
        foreach ($id_array as $id) {
            \App\Inquiry::anonymousInquiry($id);
        }
        return redirect()->back()->with('message', __('admin-inquiry.anonymousInquirySuccessMessage'));
    }

    public function getAnonymousInquiryModal(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $return_array['ModalTitle'] = 'Anonyme Anfrage';
        $return_array['id'] = $request->id;
        return (string)view('inquiry-admin.anonymous-inquiry-modal')->with($return_array);
    }

    public function addNewInquiry()
    {
        return view('inquiry-admin.new-inquiry')->with($this->return_array);
    }

    public function addNewInquiryProcess(Request $request)
    {
        $this->validate($request, [
            'created_at' => 'required',
            'domain' => 'required',
            'gender' => 'required',
            'website_language' => 'required',
            'surname' => 'required',
            'email' => 'required|email',
        ]);

        $domainDetails = \App\Domain::findDomainByName($request->domain);
        if (isset($domainDetails->id) && !empty($domainDetails->id)) {
            $requestArray = $request->except(['_token', 'domain']);
            $requestArray['domain_id'] = $domainDetails->id;
            \App\Inquiry::saveInquiry($requestArray);
            return redirect()->back()->with('message', __('admin-inquiry.addInquirySuccessMessage'));
        } else {
            return redirect()->back()
                ->withInput($request->input())
                ->with('error', 'Ungültiger Domainname');
        }
    }

    public function index()
    {
        \App\User::clearSession($this->session_name);
        $this->return_array['page_length'] = 500;
        $this->return_array['columns'] = array(
            'checkbox' => array(
                'name' => '',//<input type="checkbox" id="selectAllCheckbox"/>
                'sort' => false,
                'width' => '2px',
            ),
            'actions' => array(
                'name' => '',
                'sort' => false,
                'width' => '18px',
            ),
            'created_at' => array(
                'name' => 'Uhrzeit',
                'sort' => true,
                'width' => '50px',
            ),
            'domains.domain' => array(
                'name' => 'Domain',
                'sort' => false,
                'width' => '100px',
            ),
            'gender' => array(
                'name' => 'Anrede',
                'sort' => false,
                'width' => '20px',
            ),
            'prename' => array(
                'name' => 'Vorname',
                'sort' => false,
                'width' => '80px',
            ),
            'surname' => array(
                'name' => 'Nachname',
                'sort' => false,
                'width' => '80px',
            ),
            'email' => array(
                'name' => 'E-Mail',
                'sort' => false,
                'width' => '138px',
            ),
            'anonymous' => array(
                'name' => 'Anonymisieren',
                'sort' => false,
                'width' => '47px',
            ),
        );
        return view('inquiry-admin.index')->with($this->return_array);
    }

    public function getAllInquiryJson()
    {
        $query = \App\Inquiry::select('inquiries.*', 'domains.domain as domain_name')
            ->join('domains', 'domains.id', '=', 'inquiries.domain_id');
        if (isset($_REQUEST['filter']) && !empty($_REQUEST['filter'])) {
            session([$this->session_name => [
                'filter' => $_REQUEST['filter'],
                'search' => $_REQUEST['search']['value'],
                'page_length' => $_REQUEST['length'],
            ]]);
            $filterArray = json_decode($_REQUEST['filter'], true);
            if (isset($filterArray['no_of_days']) && !empty($filterArray['no_of_days']) && is_numeric($filterArray['no_of_days'])) {
                $query->whereBetween('inquiries.created_at', [date('Y-m-d', strtotime("-" . $filterArray['no_of_days'] . " days")) . " 00:00:00", date('Y-m-d') . " 23:59:59"]);
            }
            if (isset($filterArray['trashed']) && !empty($filterArray['trashed'])) {
                if ($filterArray['trashed'] == 'yes') {
                    $query->withTrashed();
                }
                if ($filterArray['trashed'] == 'only') {
                    $query->onlyTrashed();
                }
            }
        } elseif (isset($_REQUEST['search']['value'])) {
            session([$this->session_name => [
                'filter' => '',
                'search' => $_REQUEST['search']['value'],
                'page_length' => $_REQUEST['length'],
            ]]);
        }

        return DataTables::of($query)
            ->addColumn('checkbox', function ($inquiry) {
                return '<input type="checkbox" data-row-id="' . $inquiry->id . '" class="selectCheckBox"/>';
            })
            ->editColumn('created_at', function ($inquiry) {
                return '<p style="text-align: right;margin: 0px">' . date('Y-m-d H:i', strtotime($inquiry->created_at)) . '</p>';
            })
            ->editColumn('domains.domain', function ($inquiry) {
                return '<a style="color:rgb(0 0 153)"  href="http://' . $inquiry->domain->domain . '" target="_blank">' . $inquiry->domain->domain . '</a>';
            })
            ->editColumn('gender', function ($inquiry) {
                if ($inquiry->gender == 'm') {
                    return 'Herr';
                } else {
                    return 'Frau';
                }
            })
            ->editColumn('prename', function ($inquiry) {
                return $inquiry->prename;
            })
            ->editColumn('surname', function ($inquiry) {
                return $inquiry->surname;
            })
            ->editColumn('email', function ($inquiry) {
                return $inquiry->email;
            })
            ->addColumn('anonymous', function ($inquiry) {
                return '<label data-href="' . route('get-anonymous-inquiry-modal') . '"
                data-id="' . $inquiry->id . '"
                style="margin-bottom: 2px;margin-top: 2px;padding:0px 4px 0px 4px"
                data-name="get-anonymous-inquiry-modal" class="OpenModal btn btn-primary btn-xs">' . ucfirst(__('admin-inquiry.anonymousButton')) . '</label>';
            })
            ->addColumn('actions', function ($inquiry) {
                return '
                <a href="' . route('edit-domain', [$inquiry->domain_id]) . '"><img src="' . url('/img/wpage.gif') . '"/></a>&nbsp;&nbsp;
                <a href="' . route('edit-inquiry', [$inquiry->id]) . '" 
                style="cursor: pointer;color: black"><i class="fa fa-edit"></i></a>';
//                &nbsp;&nbsp;
//                <label data-href="' . route('get-delete-inquiry-modal') . '"
//                data-id="' . $inquiry->id . '"
//                data-name="get-delete-inquiry-modal" style="cursor: pointer" class="OpenModal"><i class="fa fa-trash"></i></label>
            })
            ->rawColumns([
                'checkbox',
                'anonymous',
                'domain_details',
                'id',
                'created_at',
                'domains.domain',
                'gender',
                'prename',
                'surname',
                'website_language',
                'browser_language',
                'email',
                'ip',
                'actions',
            ])->make(true);
    }
}
