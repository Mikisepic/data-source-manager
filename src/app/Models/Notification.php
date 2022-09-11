<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'user_id',
    'type',
    'title',
    'body'
  ];

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
    return $this->belongsTo(User::class);
  }
}
