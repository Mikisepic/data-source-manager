<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'username',
    'first_name',
    'last_name',
    'email',
    'password',
    'location',
    'occupation',
    'description',
    'academic_status',
  ];

  /**
   * The attributes that should be hidden for serialization.
   *
   * @var array<int, string>
   */
  protected $hidden = [
    'password',
    'remember_token',
  ];

  /**
   * The attributes that should be cast.
   *
   * @var array<string, string>
   */
  protected $casts = [
    'id' => 'string',
    'email_verified_at' => 'datetime',
  ];

  /**
   * Get the Data Sources the user has created.
   */
  public function dataSources()
  {
    return $this->hasMany(DataSource::class);
  }

  /**
   * Get the Collections the user has created.
   */
  public function collections()
  {
    return $this->hasMany(Collection::class);
  }

  /**
   * Get the Groups the user has created.
   */
  public function groups()
  {
    return $this->hasMany(Group::class);
  }

  /**
   * Get the Groups the user belongs to.
   */
  public function groupMembers()
  {
    return $this->belongsToMany(Group::class);
  }
}
