<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\ChildCategory;

class Attributes extends Model
{
    use HasFactory;
    protected $hidden = ["created_at","updated_at","id","child_category"];
    protected $fillable = [
        "name",
        "value",
        "child_category"
    ];

    protected $casts = [
        'value' => 'array'
    ];

    public function child_category(){
        return $this->belongsTo(ChildCategory::class,"child_category","id");
    }
}
