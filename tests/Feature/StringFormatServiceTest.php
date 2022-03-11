<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\StringFormatService;

class StringFormatServiceTest extends TestCase
{

  public function setUp(): void
  {
    parent::setUp();
    $this->stringFormatService = new StringFormatService();
  }

  public function test_phone_storage_formats_correctly()
  {
    foreach($this->getPhoneStorageMap() as $key => $value) {
      $this->assertTrue($this->stringFormatService->phoneStorageFormat($key) == $value);
    }
  }

  public function test_phone_display_formats_correctly()
  {
    foreach($this->getPhoneDisplayMap() as $key => $value) {
      $this->assertTrue($this->stringFormatService->phoneDisplayFormat($key) == $value);
    }
  }

  public function test_currency_storage_formats_correctly()
  {
    foreach($this->getCurrencyStorageMap() as $key => $value) {
      $this->assertTrue($this->stringFormatService->currencyStorageFormat($key) == $value);
    }
  }

  public function test_currency_display_formats_correctly()
  {
    foreach($this->getCurrencyDisplayMap() as $key => $value) {
      $this->assertTrue($this->stringFormatService->currencyDisplayFormat($key) == $value);
    }
  }

// ---------------------------------------------------
// Helper Methods
// ---------------------------------------------------

  private function getPhoneStorageMap()
  {
    // Mapping of potential user input to desired database storage formats
    return [
      '1 608 575 1066' => '16085751066',
      '+1 608-575-1066' => '16085751066',
      '+1 (608) 575-1066' => '16085751066',
      '+1.608.575.1066' => '16085751066',
      '608 575-1066' => '6085751066',
      '(608) 575-1066' => '6085751066',
      '575-1066' => '5751066',
      '575-106' => '575106',
    ];
  }

  private function getPhoneDisplayMap()
  {
    // Mapping of potential database formats to end-user display format
    return [
      '16085751066' => '+1 (608) 575-1066',
      '6085751066' => '(608) 575-1066',
      '5751066' => '575-1066',
      '1-608-575-1066' => '+1 (608) 575-1066',
      '575106' => '575106', // test invalid phone number format
    ];
  }

  private function getCurrencyStorageMap()
  {
    // Mapping of potential user input to desired database storage formats
    return [
      '$1099.00' => '1099.00',
      '$ 1099.00' => '1099.00',
      '$1,099.00' => '1099.00',
      '$1,0#99.00' => '1099.00',
    ];
  }

  private function getCurrencyDisplayMap()
  {
    // Mapping of potential database formats to end-user display format
    return [
      '10' => '$10.00',
      '10.1' => '$10.10',
      '10.01' => '$10.01',
      '1099.00' => '$1,099.00',
      '1099.00' => '$1,099.00',
    ];
  }

}
