<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $table = 'links';
    
    protected $primaryKey = 'id';
    
    protected $fillable = ['url','shortcut'];
    
    protected $dateFormat = "U";

    
    public function user()
    {
      return $this->belongsTo(User::class,'user_id');
    }
}
