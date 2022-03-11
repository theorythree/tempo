<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\StringFormatService;

class ProjectRequest extends FormRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'client_id' => ['required', 'numeric'],
      'name' => ['required', 'string'],
      'description' => ['nullable'],
      'budget' => ['nullable','numeric'],
    ];
  }

  protected function prepareForValidation(): void
  {
    $budget = (new StringFormatService())->currencyStorageFormat($this->budget);
    $this->merge([
      'budget' => $budget,
    ]);
  }
}
