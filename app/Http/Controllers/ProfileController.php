<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $profile= Profile::all()->sortByDesc('updated_at');

        if (count($profile) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // profile/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('admin.profile.index', ['profiles' => $profiles]);
    }

    
}
