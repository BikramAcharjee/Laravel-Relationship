<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChildCategory;
use App\Models\SuperCategory;

class SubCategory extends Model
{
    use HasFactory;
    protected $table = "sub_categories";
    protected $hidden = ["created_at","updated_at","id","super_category"];
    protected $fillable = [
        "name",
        "image_path",
        "slug",
        "child",
        "super_category"
    ];

    public function child_category() {
        return $this->hasMany(ChildCategory::class, "sub_category", "id");
    }

    public function super_category() {
        return $this->belongsTo(Supercategory::class, "super_category", "id");
    }
}
