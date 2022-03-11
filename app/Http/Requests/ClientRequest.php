<?php

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Services\StringFormatService;

class ClientRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
      return [
        'name' => ['required', 'string'],
        'code' => ['required', 'string'],
        'phone' => ['nullable'],
        'address' => ['nullable'],
      ];
    }

  protected function prepareForValidation(): void
  {
    $phone = (new StringFormatService())->phoneStorageFormat($this->phone);
    $this->merge([
      'phone' => $phone,
    ]);
  }
}
