<?php

namespace App\Http\Controllers\Edt;

use App\Http\Controllers\Controller;
use App\Models\Edt\Seance;
use App\Models\Module\Module;
use App\Models\Sale\Sale;
use App\Models\Section\Section;
use App\Models\User;
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

            $list = Seance::get();
            foreach ($list as $item) {
                $day  = $item->Day;
                $days = array(0 => 'Monday', 1 => 'Tuesday', 2 => 'Wednesday', 3 => 'Thursday', 4 => 'Friday', 5 => 'Saturday', 6 => 'Sunday');
                $date =  date('Y-m-d', strtotime($days[$day], strtotime('last Monday')));
                $seances[] = [
                    'id' => $item->id,
                    'seanceId' => $item->id,
                    'title' => $item->Label,
                    'start' => $date . ' ' . date('H:i:s', strtotime($item->Start)),
                    'end' => $date . ' ' . date('H:i:s', strtotime($item->End)),
                    'startReal' => date('H:i', strtotime($item->Start)),
                    'endReal' => date('H:i', strtotime($item->End)),
                    'day' => $item->getDay(),
                    'coach' => [
                        'id' => Auth::user()->id,
                        'name' => Auth::user()->getFullname(),
                        'image' => Auth::user()->getImage(),
                    ],
                    // 'start' =>  date('Y-m-'  .  str_pad($item->Day, 2, 0, STR_PAD_LEFT)) . ' ' . date('H:i:s', strtotime($item->Start)),
                    // 'end' => date('Y-m-'  . str_pad($item->Day, 2, 0, STR_PAD_LEFT))  . ' ' . date('H:i:s', strtotime($item->End)),
                    'color' => '#fff',
                    'sale' => [
                        'id' => $item->sale->id,
                        'label' => $item->sale->Label,
                    ],
                    'module' => [
                        'id' => $item->module->id,
                        'label' => $item->module->Label,
                    ],
                    'borderColor' => '#fff',
                    'textColor' =>  "#fff",
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
                'coachs' => [],
            ];
            $days = Seance::days();
            $sections = Section::all();
            $modules = Module::all();
            $sales = Sale::all();
            $coachs = User::where('role', 5)->get();
            foreach ($sections as   $item) {
                $data['sections'][] = [
                    'id' => $item->id,
                    'label' => $item->Label,
                ];
            }
            foreach ($sales as   $item) {
                $data['sales'][] = [
                    'id' => $item->id,
                    'label' => $item->Label,
                ];
            }
            foreach ($modules as   $item) {
                $data['modules'][] = [
                    'id' => $item->id,
                    'label' => $item->Label,
                ];
            }
            foreach ($coachs as   $item) {
                $data['coachs'][] = [
                    'id' => $item->id,
                    'name' => $item->getFullName(),
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
                'start' => 'required',
                'end' => 'required',
                // 'section' => 'required',
                'module' => 'required',
                'coach' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => [$validation->messages()->all()]], 403);
            }
            $module = Module::find($request->module);
            $seance = Seance::create([
                'Label' => $module->Label,
                'Date' => date("Y-m-d H:i:s"),
                'Day' => $request->day,
                'Start' => $request->start,
                'End' => $request->end,
                'Sale' => $request->sale,
                'Section' => $module->section->id,
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
                'start' => 'required',
                'end' => 'required',
                // 'section' => 'required',
                'module' => 'required',
                'coach' => 'required',
            ]);
            if ($validation->messages()->all()) {
                return response(['msg' => [$validation->messages()->all()]], 403);
            }
            $module = Module::find($request->module);
            $seance->update([
                'Label' =>                 $module->Label,
                'Date' => date("Y-m-d H:i:s"),
                'Day' => $request->day,
                'Start' => $request->start,
                'End' => $request->end,
                'Sale' => $request->sale,
                'Section' => $module->section->id,
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
