<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class TimeEntryRequest extends FormRequest
{
  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {
    return auth()->check();
  }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'project_id' => ['required', 'numeric'],
        'time_sheet_id' => ['required', 'numeric'],
        'duration' => ['numeric'],
      ];
    }

  protected function prepareForValidation(): void
  {
    $duration = $this->duration;

    if (str_contains((String) $this->duration, ':')) {
      $durationParts = explode(":",$this->duration);
      $duration = ($durationParts[0] * 60) + $durationParts[1];
    }

    if (str_contains((String) $this->duration, '.')) {
      $duration = ($this->duration * 60);
    }

    $this->merge([
      'duration' => $duration,
    ]);
  }
}
