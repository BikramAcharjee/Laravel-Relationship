<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;

class ChildCategory extends Model
{
    use HasFactory;
    protected $table = "child_categories";
    protected $hidden = ["created_at","updated_at","id","sub_category"];
    protected $fillable = [
        "name",
        "image_path",
        "slug",
        "sub_category"
    ];

    public function sub_category() {
        return $this->belongsTo(SubCategory::class, "sub_category", "id");
    }
}
