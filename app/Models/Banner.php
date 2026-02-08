<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['headline', 'subheadline', 'image', 'cta_text', 'cta_link', 'sort_order', 'is_active'];
}
