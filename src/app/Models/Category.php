<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
use HasFactory;

protected $fillable = ['content'];

// contactsテーブルとの1対多リレーション
public function contacts()
{
return $this->hasMany(Contact::class);
}
}