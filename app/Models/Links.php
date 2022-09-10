<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class Links extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'links';
    protected $dates = ['deleted_at'];
    protected $fillable = ['short_link', 'link', 'token'];

    const LIMIT = 100;  // constant set to use in limit function

    // setting string limit
    public function limit()
    {
        return Str::limit($this->links, Links::LIMIT);
    }
}
