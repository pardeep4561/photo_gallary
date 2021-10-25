<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
class Photo extends Model
{
    use HasFactory;
    protected $fillable =['category_id','user_id','name','file_name'];
    protected $appends = ['time'];
    
    function getTimeAttribute(){
        return Carbon::createFromTimeString($this->created_at)->diffForHumans();
    }

   function user()
   {
     return $this->belongsTo(User::class);
   }

   function category(){
       return $this->belongsTo(Category::class);
   }
}
