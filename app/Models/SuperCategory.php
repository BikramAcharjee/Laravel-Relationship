<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\ChildCategory;

class SuperCategory extends Model
{
    use HasFactory;
    protected $table = "super_categories";
    protected $hidden = ["created_at","updated_at","id"];
    protected $fillable = [
        "name",
        "image_path",
        "slug",
        "child"
    ];

    public function sub_category() {
        return $this->hasMany(SubCategory::class, "super_category", "id");
    }

    public function child_category() {
        return $this->hasManyThrough(ChildCategory::class,SubCategory::class,"super_category","sub_category","id","id");
    }
}
