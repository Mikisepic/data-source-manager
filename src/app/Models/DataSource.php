<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSource extends Model
{
  use HasFactory;

  /**
   * The attributes that are mass assignable.
   *
   * @var array<int, string>
   */
  protected $fillable = [
    'id',
    'user_id',
    'title',
    'source',
    'category',
    'expires_at'
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
   * Get the User that added the Data Source.
   */
  public function user()
  {
    return $this->belongsTo(User::class);
  }

  /**
   * Get the Collection that has this Data Source.
   */
  public function collection()
  {
    return $this->belongsTo(Collection::class);
  }

  /**
   * Get the Group that has this Data Source.
   */
  public function group()
  {
    return $this->belongsTo(Group::class);
  }
}
