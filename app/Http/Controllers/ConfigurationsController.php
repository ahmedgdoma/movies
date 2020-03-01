<?php

namespace App\Http\Controllers;

use App\Configration;
use App\traits\ApiGetDataTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ConfigurationsController extends Controller
{
    use ApiGetDataTrait;


    public function edit(){
        $data = [];
        $data['number_of_recent'] = Configration::getConfigValue('number_of_recent');
        $data['top_rated'] = Configration::getConfigValue('number_of_top_rated');
        $data['interval_timer'] = Configration::getConfigValue('interval_timer');
        return view('configuration.update', compact('data'));
    }

    public function update(Request $request){

        $request->validate([
            'number_of_recent' => 'bail|required|numeric|gt:0|max:99999',
            'top_rated' => 'bail|required|numeric|gt:0|max:99999',
            'interval_timer' => 'bail|required|numeric|gt:0|max:999',
        ]);

        try{
            Configration::where('config_name', 'number_of_recent')
                ->update(['config_value'=> $request->get('number_of_recent')]);

            Configration::where('config_name', 'number_of_top_rated')
                ->update(['config_value'=> $request->get('top_rated')]);

            Configration::where('config_name', 'interval_timer')
                ->update(['config_value'=> $request->get('interval_timer')]);
        }catch (\Exception $e){
            Log::error($e);
            session()->flash('failed', 'sorry update failed');
            return redirect()->back();
        }
        session()->flash('success', 'updated Successfully');
        return redirect()->route('edit-config');
    }
}
