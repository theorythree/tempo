<?php

namespace App\Services;

class StringFormatService
{
  public function phoneStorageFormat($value)
  {
    return preg_replace("/[^0-9]/", "", $value);
  }

  public function phoneDisplayFormat($value) 
  {
    $phoneNumber = preg_replace("/[^0-9]/", "", $value);

    if(strlen($phoneNumber) > 10) {
      
      $countryCode = substr($phoneNumber, 0, strlen($phoneNumber)-10);
      $areaCode = substr($phoneNumber, -10, 3);
      $nextThree = substr($phoneNumber, -7, 3);
      $lastFour = substr($phoneNumber, -4, 4);
      return '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
    
    } else if(strlen($phoneNumber) == 10) {
    
      $areaCode = substr($phoneNumber, 0, 3);
      $nextThree = substr($phoneNumber, 3, 3);
      $lastFour = substr($phoneNumber, 6, 4);
      return '('.$areaCode.') '.$nextThree.'-'.$lastFour;
    
    } else if(strlen($phoneNumber) == 7) {
    
      $nextThree = substr($phoneNumber, 0, 3);
      $lastFour = substr($phoneNumber, 3, 4);
      return $nextThree.'-'.$lastFour;
    } 
      
    return $value;
  }

  public function currencyStorageFormat($value)
  {
    return preg_replace("/[^0-9.]/", "", $value);
  }

  public function currencyDisplayFormat($value)
  {
    return "$".number_format($value, 2, '.', ',');
  }
}
