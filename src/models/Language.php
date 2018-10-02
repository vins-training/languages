<?php

namespace Nvt1904\Languages;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //
    protected $table = 'languages';
    protected $fillable = [
        'id','key', 'en', 'vn','page'
    ];
}
