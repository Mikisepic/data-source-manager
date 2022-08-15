<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = ['title', 'description'];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'id' => 'string'
  ];

  /**
   * Get the User that owns the Group.
   */
  public function owner()
  {
    return $this->belongsTo('App\Models\User');
  }

  /**
   * Get the Users that are members of this Group.
   */
  public function members()
  {
    return $this->hasMany('App\Models\User');
  }

  /**
   * Get the Data Sources the Group has inside.
   */
  public function dataSources()
  {
    return $this->hasMany('App\Models\DataSource');
  }
}
