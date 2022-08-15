<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['title'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'id' => 'string'
  ];

  /**
   * Get the User that added the Collection.
   */
  public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * Get the Data Sources the user has created.
   */
  public function dataSources()
  {
    return $this->hasMany('App\Models\DataSource');
  }
}
