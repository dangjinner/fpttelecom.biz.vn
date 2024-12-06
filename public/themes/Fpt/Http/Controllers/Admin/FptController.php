<?php

namespace Themes\Fpt\Http\Controllers\Admin;

use Modules\Admin\Ui\Facades\TabManager;
use Themes\Anan\Http\Requests\SaveAnanRequest;
use Themes\Fpt\Http\Requests\SaveFptRequest;

class FptController
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $settings = setting()->all();
        $tabs = TabManager::get('fpt');
        return view('admin.fpt.edit', compact('settings', 'tabs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(SaveFptRequest $request)
    {
        setting($request->except('_token', '_method'));

        return back()->withSuccess(trans('admin::messages.resource_saved', ['resource' => trans('setting::settings.settings')]));
    }
}