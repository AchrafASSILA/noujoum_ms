<?php

namespace App\Http\Controllers\Statistic;

use App\Http\Controllers\Controller;
use App\Models\Fnc\FncEncaissementLine;
use App\Models\Service\Service;

class StatisticController extends Controller

{
    /**
     * Display a listing of the resource.
     */
    public function etats()
    {
        try {
            $months = Service::getMonthsWithName();
            foreach ($months as $key => $item) {
                $data['months'][] = $item;
                $data['servicesValues'][] = FncEncaissementLine::whereNull('Canceled')->whereMonth('created_at', '=',  $key)->sum('Amount');
            }



            return response($data, 200);
        } catch (\Exception $e) {
            //throw $th;
            return response(['msg' => $e->getMessage()], 400);
        }
    }
}
