<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Helper\epp;

class EPPControler extends Controller
{

    public function __construct()
    {
        $this->epp = new epp();
    }

    public function domain()
    {
        $return_array['sidebar'] = "Epp Domain";
        if (isset($_POST['domain_name']) && !empty($_POST['domain_name'])) {
            $return_array['search'] = $_POST['domain_name'];
            $results = $this->epp->getDomainInfo(trim($_POST['domain_name']));
            if (is_array($results)) {
                foreach ($results as $key => $value)
                    $return_array[$key] = $value;
                session(['selected_domain' => $_POST['domain_name']]);
            } else {
                $return_array['error'] = $results;
            }
        }
        return view('epp-admin.domain')->with($return_array);
    }

    public function messages()
    {
        session(['selected_domain' => '']);
        $return_array['sidebar'] = "Epp Messages";
        $return_array['poll'] = $this->epp->poll_results();
        return view('epp-admin.messages')->with($return_array);
    }

    public function pollAck(Request $request)
    {
        $message_id = $request->message_id;
        $this->epp->ack_result($message_id);
        return redirect(route('epp-messages'));
    }

    public function undelete()
    {
        session(['selected_domain' => '']);
        $return_array['sidebar'] = "Epp Undelete";
        return view('epp-admin.undelete')->with($return_array);
    }

    public function undeleteConfirm(Request $request)
    {
        session(['selected_domain' => '']);
        $this->validate($request, [
            'names' => 'required'
        ]);
        $return_array['sidebar'] = "Epp Undelete";
        $return_array['names'] = preg_split('/[\s,]+/', $request->names, -1, PREG_SPLIT_NO_EMPTY);
        $return_array['names_json'] = json_encode($return_array['names']);
        return view('epp-admin.undelete-confirm')->with($return_array);
    }

    public function undeleteConfirmProcess(Request $request)
    {
        session(['selected_domain' => '']);
        $this->validate($request, [
            'names' => 'required'
        ]);
        $names = json_decode($request->names);
        $this->epp->undelete_multi($names);
        return redirect(route('epp-undelete'))->with('message', 'Domains were successfully restored');
    }

    public function delete()
    {
        session(['selected_domain' => '']);
        $return_array['sidebar'] = "Epp Delete";
        return view('epp-admin.delete')->with($return_array);
    }

    public function deleteConfirm(Request $request)
    {
        session(['selected_domain' => '']);
        $this->validate($request, [
            'names' => 'required'
        ]);
        $return_array['sidebar'] = "Epp Delete";
        $return_array['names'] = preg_split('/[\s,]+/', $request->names, -1, PREG_SPLIT_NO_EMPTY);
        $return_array['names_json'] = json_encode($return_array['names']);
        return view('epp-admin.delete-confirm')->with($return_array);
    }

    public function deleteConfirmProcess(Request $request)
    {
        session(['selected_domain' => '']);
        $this->validate($request, [
            'names' => 'required'
        ]);
        $names = json_decode($request->names);
        $this->epp->delete_multi($names);
        return redirect(route('epp-delete'))->with('message', 'Domains were deleted successfully');
    }

    public function transfer()
    {
        $return_array['sidebar'] = "Epp Transfer";
        return view('epp-admin.transfer')->with($return_array);
    }

    public function transferDomain(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
            'handle' => 'required',
            'tech' => 'required',
            'dns1' => 'required',
            'dns2' => 'required',
        ]);
        if (!empty(session('selected_domain'))) {
            $this->epp->transfer(session('selected_domain'), $request->code, $request->handle, $request->tech, $request->dns1, $request->dns2);
        }
        return redirect(route('epp-transfer'))->with('message', 'Domains were successfully transferred');
    }

    public function authcode()
    {
        $return_array['sidebar'] = "Epp Auth Code";
        return view('epp-admin.authcode')->with($return_array);
    }

    public function updateAuthCode(Request $request)
    {
        $this->validate($request, [
            'code' => 'required'
        ]);
        if (!empty(session('selected_domain'))) {
            $this->epp->set_authinfo(session('selected_domain'), $request->code);
        }
        return redirect(route('epp-authcode'))->with('auth_code', $request->code);
    }

    public function generateRandomCode()
    {
        $code = 'failed to fetch the code';
        if (!empty(session('selected_domain'))) {
            $code = $this->epp->lowerCaseAndDigits(12);
            $this->epp->set_authinfo(session('selected_domain'), $code);
        }
        return redirect(route('epp-authcode'))->with('auth_code', $code);
    }

    public function register()
    {
        $return_array['sidebar'] = "Epp Register";
        return view('epp-admin.register')->with($return_array);
    }

    public function registerDomain(Request $request)
    {
        $this->validate($request, [
            'handle' => 'required',
            'tech' => 'required',
            'dns1' => 'required',
            'dns2' => 'required',
        ]);
        $created_at = "";
        $expired_at = "";
        if (!empty(session('selected_domain'))) {
            $response = $this->epp->register(session('selected_domain'), $request->handle, $request->tech, $request->dns1, $request->dns2);
            if (isset($response['creation_date']) && isset($response['expiration_date'])) {
                $created_at = $response['creation_date'];
                $expired_at = $response['expiration_date'];
            }
        }
        return redirect(route('epp-register'))->with([
            'created_at' => $created_at,
            'expired_at' => $expired_at,
        ]);
    }
}
