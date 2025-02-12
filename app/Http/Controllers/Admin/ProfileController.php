<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Profile;
use App\Models\History;
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
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            $posts = News::where('title', $cond_title)->get();   
        } else {
            $posts = News::all();

        }
             return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
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
        $news = profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();

        if ($request->remove == 'true') {
            $news_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $news_form['image_path'] = basename($path);
        } else {
            $news_form['image_path'] = $news->image_path;
        }

        unset($news_form['image']);
        unset($news_form['remove']);
        unset($profile_form['_token']);
        $profile->fill($profile_form)->save();

        return redirect('admin/profile');

    }

}