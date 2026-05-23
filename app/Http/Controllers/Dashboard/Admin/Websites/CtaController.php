<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Cta\CtaRequest;
use Illuminate\Contracts\View\View;

class CtaController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-websites'), 403);

        $breadcrumb = [['trans' => 'admin.websites.cta']];

        return view('dashboard.admin.websites.cta', compact('breadcrumb'));
    }

    public function store(CtaRequest $request)
    {
        setting('cta')->save($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();
    }
}
