<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $fillable = ['name'];

    public function contacts()
    {
        return $this->belongsToMany(Contacts::class, 'contact_tags');
    }
}
