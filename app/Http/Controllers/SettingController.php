<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $general = Setting::all();

        return view('settings.general.index', compact('general'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    // Controller
    public function update(Request $request, Setting $setting)
    {
        $settingId = $request->input('setting_id');
        $settingValue = $request->input('setting_value');

        // Update the setting in the database
        $setting = Setting::findOrFail($settingId);

        // if empty, use the default value
        if (empty($settingValue)) {
            $settingValue = $setting->default_value;
        }

        $setting->value = $settingValue;
        if ($setting->save()) {
            return response()->json(['message' => "Le " . $setting->title . " a été mis à jour avec succès"], 200);
        } else {
            return response()->json(['error' => "Une erreur est survenue lors de la mise à jour du " . $setting->title], 500);
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
