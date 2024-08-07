<?php

namespace App\Http\Controllers\Edt;

use App\Http\Controllers\Controller;
use App\Models\Edt\Seance;
use App\Models\Module\Module;
use App\Models\Sale\Sale;
use App\Models\Section\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SeanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        try {
            $days = Seance::days();
            $seances = [];
            // foreach ($days as $key => $item) {
            // where("Day", $key)
            $list = Seance::get();
            foreach ($list as $item) {
                $seances[] = [
                    'id' => $item->get('ID'),
                    'title' => $item->Label . ' ' . $item->module->Label,
                    'start' =>  date('Y-m-'  .  str_pad($item->Day, 2, 0, STR_PAD_LEFT)) . ' ' . date('H:i:s', strtotime($item->Start)),
                    'end' => date('Y-m-'  . str_pad($item->Day, 2, 0, STR_PAD_LEFT))  . ' ' . date('H:i:s', strtotime($item->End)),
                    'color' => '',
                    'borderColor' => '',
                    'textColor' =>  "#fff",
                    'imagerul' => '',
                ];
            }
            // }
            $data['seances'] = $seances;

            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $data = [
                'sections' => [],
                'sales' => [],
                'modules' => [],
            ];
            $days = Seance::days();
            $sections = Section::all();
            $modules = Module::all();
            $sales = Sale::all();
            foreach ($sections as   $item) {
                $data['sections'][] = [
                    'id' => $item->get('ID'),
                    'label' => $item->Label,
                ];
            }
            foreach ($sales as   $item) {
                $data['sales'][] = [
                    'id' => $item->get('ID'),
                    'label' => $item->Label,
                ];
            }
            foreach ($modules as   $item) {
                $data['modules'][] = [
                    'id' => $item->get('ID'),
                    'label' => $item->Label,
                ];
            }
            $data['days'] = $days;
            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $validation = Validator::make($request->all(), [
                'day' => 'required|integer',
                'start' => 'required|time',
                'end' => 'required|time',
                'section' => 'required',
                'module' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $seance = Seance::create([
                'Label' => $request->label,
                'Date' => date("Y-m-d H:i:s"),
                'Day' => $request->day,
                'Start' => $request->start,
                'End' => $request->end,
                'Sale' => $request->sale,
                'Section' => $request->section,
                'Module' => $request->module,
                'UserBy' => Auth::user()->id,
            ]);
            return response(['msg' => 'seance save with succes', 'seance' => $seance], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => $e->getMessage()], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        try {
            $seance =  Seance::find($id);
            $validation = Validator::make($request->all(), [
                'day' => 'required|integer',
                'start' => 'required|time',
                'end' => 'required|time',
                'section' => 'required',
                'module' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => $validation->messages()->all()], 403);
            }

            $seance->update([
                'Label' => $request->label,
                'Date' => date("Y-m-d H:i:s"),
                'Day' => $request->day,
                'Start' => $request->start,
                'End' => $request->end,
                'Sale' => $request->sale,
                'Section' => $request->section,
                'Module' => $request->module,
                'UserBy' => Auth::user()->id,
            ]);
            return response(['msg' => 'seance save with succes', 'seance' => $seance], 200);
        } catch (\Exception $e) {
            //throw $e;
            return response(['msg' => $e->getMessage()], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            //code...
            $data = array();
            $data['msg'] = 'deleted succesfully';
            $seance = Seance::find($id);
            $seance->delete();
            return response($data, 200);
        } catch (\Exception $e) {
            return response(['msg' => $e->getMessage()], 200);
        }
    }
}
