<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Article extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles';

    protected $fillable = ['title','summary','body','author','email'];

}
