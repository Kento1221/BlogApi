<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleToApproval extends Model
{
    use HasFactory, SoftDeletes;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->hasOne(Article::class);
    }

    public function setApprovedByAttribute($id)
    {
        return $this->attributes['approved_by'] = $id;
    }

    public function setNumberOfDeletesAttribute($number)
    {
        return $this->attributes['number_of_delete'] = $number;
    }
}
