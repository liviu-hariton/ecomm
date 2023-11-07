<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use stdClass;

class SettingsController extends Controller
{
    public function index()
    {
        $temp_settings = null;

        return view('admin.settings.index', [
            'settings' => Settings::first() ?? $temp_settings
        ]);
    }

    public function updateGeneral(Request $request)
    {
        $validated_data = $request->validate([
            'site_name' => 'required|max:200',
            'layout' => 'required',
            'contact_email' => 'required|email',
            'currency_name' => 'required',
            'currency_icon' => 'required',
            'timezone' => 'required'
        ]);

        Settings::updateOrCreate(
            ['id' => 1],
            $validated_data
        );

        toastr('General settings updated successfully');

        return redirect()->route('admin.settings.index');
    }

    public function updateSeo(Request $request)
    {
        $validated_data = $request->validate([
            'meta_title' => 'required|max:200',
            'meta_description' => 'required|max:200'
        ]);

        Settings::updateOrCreate(
            ['id' => 1],
            $validated_data
        );

        toastr('SEO settings updated successfully');

        return redirect()->route('admin.settings.index');
    }
}
