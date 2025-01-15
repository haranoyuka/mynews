<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $guarded = array('id');

    public static $rules = array(
        '名前' => 'required',
        '性別' => 'required',
        '趣味' => 'required',
        '自己紹介欄' => 'required',
    );
}
