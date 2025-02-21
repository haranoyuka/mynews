<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\ProfileHistory;
use Carbon\Carbon;
//use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        //Log::debug($request);
        $this->validate($request, Profile::$rules);
        $profile = new Profile;
        $form = $request->all();

       unset($form['_token']);
        $profile->fill($form);
        $profile->save();
        return redirect('admin/profile/create');
    }  

    public function index(Request $request)
    {
        $profiles = Profile::all();
            return view('admin.profile.index', ['profiles' => $profiles]);
    }

    public function edit(Request $request)
    {
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Profile::$rules);
        // Profiles Modelからデータを取得する
        $profile = profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();

        $profile->fill($profile_form)->save();

        $profilehistory = new ProfileHistory();
        $profilehistory->profile_id = $profile->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();

        return redirect('admin/profile');

    }

}