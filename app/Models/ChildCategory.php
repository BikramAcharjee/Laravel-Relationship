<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Attributes;

class ChildCategory extends Model
{
    use HasFactory;
    protected $table = "child_categories";
    protected $hidden = [
        "created_at",
        "updated_at",
        "image_path",
        "slug",
        "id",
        "sub_category"
    ];
    protected $fillable = [
        "name",
        "image_path",
        "slug",
        "sub_category"
    ];

    public function attributes(){
        return $this->hasMany(Attributes::class,"child_category","id");
    }

    public function sub_category() {
        return $this->belongsTo(SubCategory::class, "sub_category", "id");
    }
}
