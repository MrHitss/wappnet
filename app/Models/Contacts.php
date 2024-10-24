<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contacts extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'mobile_number', 'image'];

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'contact_tags');
    }

}
