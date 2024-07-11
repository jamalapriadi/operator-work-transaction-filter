<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OperatorWork;

use App\Transformers\OperatorWorkTransformer;

class OperatorWorkController extends Controller
{
    public function index(Request $request)
    {
        $model = OperatorWork::select('*');

        if($request->filled('q')){
            $q = $request->input('q');

            $model = $model->where(function($query) use($q){
                $query->where('submitted_by','like','%'.$q.'%')
                    ->orWhere('site_code','like','%'.$q.'%')
                    ->orWhere('activity','like','%'.$q.'%')
                    ->orWhere('uom','like','%'.$q.'%')
                    ->orWhere('block','like','%'.$q.'%')
                    ->orWhere('mesin_id','like','%'.$q.'%')
                    ->orWhere('fuel','like','%'.$q.'%');
            });
        }

        if($request->filled('mesin'))
        {
            $model = $model->where('mesin_id', $request->input('mesin'));
        }

        if($request->filled('site'))
        {
            $model = $model->where('site_code', $request->input('site'));
        }

        if($request->filled('operator'))
        {
            $model = $model->where('submitted_by', $request->input('operator'));
        }

        if($request->filled('activity'))
        {
            $model = $model->where('activity', $request->input('activity'));
        }

        if($request->filled('month'))
        {
            $month = date('Y-m', strtotime($request->input('month')));

            $model = $model->where(function($query) use($month){
                $query->where(\DB::raw("DATE_FORMAT(submitted_when, '%Y-%m')"), $month)
                    ->orWhere(\DB::raw("DATE_FORMAT(start, '%Y-%m')"), $month)
                    ->orWhere(\DB::raw("DATE_FORMAT(end, '%Y-%m')"), $month);
            });
        }

        if($request->filled('per_page')){
            $halaman=$request->input('per_page');
        }else{
            $halaman=10;
        }

        $model = $model->paginate($halaman);

        $response = fractal($model, new OperatorWorkTransformer())
            ->toArray();

        return response()->json($response, 200);
    }

    public function list_filter(Request $request)
    {
        $mesins = OperatorWork::groupBy('mesin_id')
            ->get()
            ->pluck('mesin_id');

        $sites = OperatorWork::groupBy('site_code')
            ->get()
            ->pluck('site_code');

        $operators = OperatorWork::groupBy('submitted_by')
            ->get()
            ->pluck('submitted_by');

        $activities = OperatorWork::groupBy('activity')
            ->get()
            ->pluck('activity');

        $data = array(
            'mesins'=>$mesins,
            'sites'=>$sites,
            'operators'=>$operators,
            'activities'=>$activities
        );

        return response()->json($data, 200);
    }
}
