<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Attributes;

class SuperCategory extends Model
{
    use HasFactory;
    protected $table = "super_categories";
    protected $hidden = [
        "created_at",
        "updated_at",
        "image_path",
        "slug",
        "id"
    ];
    protected $fillable = [
        "name",
        "image_path",
        "slug",
        "child"
    ];

    public function sub_category() {
        return $this->hasMany(SubCategory::class, "super_category", "id");
    }
}
