<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Subcategory extends Model
{
    use HasFactory;

    protected $fillable = ['subcategory_name','subcategory_slug','category_id'];

    public function category(){ // one to one relation---belongs to means subcategory... category table er modde ontorgoto..
    	return $this->belongsTo(Category::class);
    }

}
