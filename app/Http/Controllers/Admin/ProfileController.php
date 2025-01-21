<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
        $news = new News;
        $form = $request->all();

        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $profiles->image_path = basename($path);
        } else {
            $news->image_path = null;
        }
        unset($form['_token']);
        unset($form['image']);
        $news->fill($form);
        $news->save();
        return redirect('admin/profile/create');
    }    
}
