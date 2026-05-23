<?php

namespace App\Http\Controllers\Dashboard\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Settings\General\GeneralRequest;
use Illuminate\Contracts\View\View;

class GeneralController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-settings'), 403);

        $breadcrumb = [['trans' => 'admin.models.settings'], ['trans' => 'admin.settings.general']];

        return view('dashboard.admin.settings.general', compact('breadcrumb'));
    }

    public function store(GeneralRequest $request)
    {
        setting('general')->save($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();
    }
}
