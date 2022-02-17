<?php

namespace App\Models;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'link',
        'votes',
        'author_name',
        'creation_date'
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public static function collection(\Illuminate\Database\Eloquent\Collection $phoneItems)
    {


    }
}
