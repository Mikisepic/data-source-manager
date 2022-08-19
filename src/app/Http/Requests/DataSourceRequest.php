<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DataSourceRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return true;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, mixed>
   */
  public function rules()
  {
    return [
      'user_id' => ['required', 'uuid'],
      'title' => ['required', 'string'],
      'source' => ['required', 'url'],
      'category' => ['required', Rule::in(['link', 'article', 'book'])],
      'expires_at' => ['required', 'date'],
    ];
  }
}
