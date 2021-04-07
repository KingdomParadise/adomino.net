<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Cropper;
use Illuminate\Support\Str;

class LogoController extends Controller
{

    public function __construct()
    {
        $this->return_array['sidebar'] = 'Logos';
    }

    public function getFilterLogoModal()
    {
        $return_array['ModalTitle'] = 'Filter Logo';
        return (string)view('logo-admin.filter-modal')->with($return_array);
    }

    public function deleteLogoProcess(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);
        \App\Logo::deleteLogo($request->id);
        return redirect()->back()->with('message', __('admin-logo.deleteLogoSuccessMessage'));
    }

    public function getDeleteLogoModal(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);
        $return_array['ModalTitle'] = __('admin-logo.deleteLogoModalTitle');
        $return_array['id'] = $request->id;
        return (string)view('logo-admin.delete-logo-modal')->with($return_array);
    }

    public function editLogo($id)
    {
        if (!is_numeric($id) || empty($id)) {
            dd('id not found');
        }
        $this->return_array['logo'] = \App\Logo::getLogo($id);
        return view('logo-admin.add-logo')->with($this->return_array);
    }

    public function addNewLogo()
    {
        return view('logo-admin.add-logo')->with($this->return_array);
    }

    public function addLogoProcess(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
            'logo' => 'required|mimes:jpeg,png,bmp,tiff'
        ]);
        $fileName = Str::uuid() . '.' . $request->logo->extension();
        $storagePath = 'public/logos/';
        $path = storage_path('app/' . $storagePath . $fileName);
        if (!Storage::disk('local')->exists($storagePath)) {
            Storage::disk('local')->makeDirectory($storagePath);
        }
        Cropper::make($request->logo)->resize(80, 40, function ($c) {
            $c->aspectRatio();
        })->resizeCanvas(80, 40, 'center', false, array(255, 255, 255, 0))
            ->save($path);
        $request_array = $request->except(['_token']);
        $requestArray['purchased_domain'] = $request_array['domain'];
        $requestArray['active'] = ($request->has('active')) ? 1 : 0;
        $requestArray['logo'] = '/logos/' . $fileName;
        $requestArray['sort'] = (\App\Logo::getLastSortNumber() + 1);
        \App\Logo::saveLogo($requestArray);
        return redirect()->back()->with('message', __('admin-logo.addLogoSuccessMessage'));
    }

    public function updateLogoProcess(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
        ]);

        if ($request->has('logo_input')) {
            $this->validate($request, [
                'logo_input' => 'required'
            ]);
            $logo = $request->logo_input;
        } else {
            $this->validate($request, [
                'logo' => 'required|mimes:jpeg,png,bmp,tiff'
            ]);
            $fileName = Str::uuid() . '.' . $request->logo->extension();
            $storagePath = 'public/logos/';
            $path = storage_path('app/' . $storagePath . $fileName);
            if (!Storage::disk('local')->exists($storagePath)) {
                Storage::disk('local')->makeDirectory($storagePath);
            }
            Cropper::make($request->logo)->resize(80, 40, function ($c) {
                $c->aspectRatio();
            })->resizeCanvas(80, 40, 'center', false, array(255, 255, 255, 0))
                ->save($path);
            $logo = '/logos/' . $fileName;
        }
        $request_array = $request->except(['_token']);
        $requestArray['purchased_domain'] = $request_array['domain'];
        $requestArray['active'] = ($request->has('active')) ? 1 : 0;
        $requestArray['logo'] = $logo;
        $requestArray['id'] = $request->id;
        $requestArray['sort'] = (\App\Logo::getLastSortNumber() + 1);
        \App\Logo::saveLogo($requestArray);
        return redirect()->back()->with('message', __('admin-logo.updateLogoSuccessMessage'));
    }

    public function sortLogo(Request $request)
    {
        $this->validate($request, [
            'mode' => 'required',
            'id' => 'required',
        ]);
        \App\Logo::sortLogo($request->mode, $request->id);
        return response()->json(['error' => 0, 'message' => 'done']);
    }

    public function index()
    {
        $this->return_array['page_length'] = -1;
        $this->return_array['columns'] = array(
            'checkbox' => array(
                'name' => '<input type="checkbox" id="selectAllCheckbox"/>',
                'sort' => false,
            ),
            'id' => array(
                'name' => 'ID',
                'sort' => true,
            ),
            'active' => array(
                'name' => 'Aktiv?',
                'sort' => false,
            ),
            'logo' => array(
                'name' => 'Logo',
                'sort' => false,
            ),
            'purchased_domain' => array(
                'name' => 'Verkaufte Domain',
                'sort' => false,
            ),
            'sort' => array(
                'name' => 'Sortierung',
                'sort' => true,
            ),
            'actions' => array(
                'name' => 'Actions',
                'sort' => false,
            ),
        );
        return view('logo-admin.index')->with($this->return_array);
    }

    public function getAllLogoJson()
    {
        $lastSorting = \App\Logo::getLastSortNumber();
        return DataTables::of(\App\Logo::query())
            ->addColumn('checkbox', function ($logo) {
                return '<input type="checkbox" data-row-id="' . $logo->id . '" class="selectCheckBox"/>';
            })
            ->editColumn('id', function ($logo) {
                return $logo->id;
            })
            ->addColumn('active', function ($logo) {
                if ($logo->active) {
                    return '<i class="fa fa-check-circle" style="font-size: 20px;color: #0cbb0cb3;"></i>';
                } else {
                    return '<i class="fa fa-times-circle" style="font-size: 20px;color: #ff0000b5;"></i>';
                }
            })
            ->addColumn('logo', function ($logo) {
                return '<img src="' . Storage::url($logo->logo) . '" style="object-fit: cover;width: 3rem;"/>';
            })
            ->editColumn('purchased_domain', function ($logo) {
                return $logo->purchased_domain;
            })
            ->editColumn('sort', function ($logo) use ($lastSorting) {
                $arrowUp = "";
                $arrowDown = "";
                if ($logo->sort != '1') {
                    $arrowUp = '<i data-url="' . route('sort-logo') . '" class="fa fa-arrow-circle-up sort" data-mode="up" data-sort="' . $logo->sort . '" data-id="' . $logo->id . '" style="font-size: 20px;cursor: pointer;"></i>&nbsp;&nbsp;';
                }
                if ($logo->sort != $lastSorting) {
                    $arrowDown = '<i data-url="' . route('sort-logo') . '" style="font-size: 20px;cursor: pointer;" data-mode="down" data-sort="' . $logo->sort . '" data-id="' . $logo->id . '" class="sort fa fa-arrow-circle-down"></i>';
                }
                return $arrowUp . $arrowDown;
            })
            ->addColumn('actions', function ($logo) {
                return '
                <a href="' . route('edit-logo', [$logo->id]) . '"
                style="cursor: pointer;color: black"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                <label data-href="' . route('get-delete-logo-modal') . '"
                data-id="' . $logo->id . '"
                data-name="get-delete-inquiry-modal" style="cursor: pointer" class="OpenModal"><i class="fa fa-trash"></i></label>';

            })
            ->rawColumns([
                'checkbox',
                'active',
                'logo',
                'sort',
                'actions',
            ])->make(true);
    }
}
