<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
use App\Services\DurationService;

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
    $duration = (new DurationService())->convertToMinutes($this->duration);

    $this->merge([
      'duration' => $duration,
    ]);
  }
}
