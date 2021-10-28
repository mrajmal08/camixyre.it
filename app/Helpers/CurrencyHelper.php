<?php

namespace App\Helpers;

use Stevebauman\Location\Facades\Location;
use Mpociot\VatCalculator\VatCalculator;
use App\Models\Settings;
use App\Models\Currency;

class CurrencyHelper
{
    // Include Vat Price Format
    public static function getSetPriceFormat($priceWithTwoDecimals)
    {
        $vatCalculator = new VatCalculator();

        $settings = Settings::first();
        $isCommaTheDecimalSeparator = $settings->comma_is_decimal_separator;
        $isIntegerPriceUsed = $settings->use_integer_prices;

        if($position = Location::get()):
            $countryCode = $position->countryCode;
        else:
            $countryCode = 'IT';
        endif;

        $priceWithTwoDecimals = $vatCalculator->calculate($priceWithTwoDecimals, strtolower($countryCode));

        $priceStringToReturn = $priceWithTwoDecimals;
        if( ($isIntegerPriceUsed) && ($priceWithTwoDecimals < 1000) )
        {
            return intval($priceStringToReturn);
        }

        if( (!$isIntegerPriceUsed) && ($priceWithTwoDecimals < 1000) )
        {
            $priceString = strval($priceWithTwoDecimals);
            if($isCommaTheDecimalSeparator)
            {
                return str_replace('.', ',', $priceString);
            }
            else
            {
                return $priceStringToReturn;
            }
        }

        if( ($isIntegerPriceUsed) && ($priceWithTwoDecimals >= 1000) )
        {
            $priceString = strval(intval($priceStringToReturn));
            if($isCommaTheDecimalSeparator)
            {
                return number_format($priceString, null, null, '.');
            }
            else
            {
                return number_format($priceString, null, null, ',');
            }
        }

        if( (!$isIntegerPriceUsed) && ($priceWithTwoDecimals >= 1000) )
        {
            $priceStringWithTwoDecimals = strval($priceWithTwoDecimals);
            $positionOfPeriod = strpos($priceStringWithTwoDecimals, '.');
            $priceStringInt = substr($priceStringWithTwoDecimals, 0, $positionOfPeriod);
            $decimalsString = substr($priceStringWithTwoDecimals, $positionOfPeriod + 1);

            if($isCommaTheDecimalSeparator)
            {
                $separatedPriceInt = number_format($priceStringInt, null, null, '.');
                return $separatedPriceInt . ',' . $decimalsString;
            }
            else
            {
                $separatedPriceInt = number_format($priceStringInt, null, null, ',');
                return $separatedPriceInt . '.' . $decimalsString;
            }
        }

        return $priceStringToReturn;
    }

    // Include Vat Price Format Admin Area
    public static function getSetPriceFormatAdmin($priceWithTwoDecimals, $region)
    {
        $vatCalculator = new VatCalculator();

        $settings = Settings::first();
        $isCommaTheDecimalSeparator = $settings->comma_is_decimal_separator;
        $isIntegerPriceUsed = $settings->use_integer_prices;
        
        $countryCode = $region;

        $priceWithTwoDecimals = $vatCalculator->calculate($priceWithTwoDecimals, strtolower($countryCode));

        $priceStringToReturn = $priceWithTwoDecimals;
        if( ($isIntegerPriceUsed) && ($priceWithTwoDecimals < 1000) )
        {
            return intval($priceStringToReturn);
        }

        if( (!$isIntegerPriceUsed) && ($priceWithTwoDecimals < 1000) )
        {
            $priceString = strval($priceWithTwoDecimals);
            if($isCommaTheDecimalSeparator)
            {
                return str_replace('.', ',', $priceString);
            }
            else
            {
                return $priceStringToReturn;
            }
        }

        if( ($isIntegerPriceUsed) && ($priceWithTwoDecimals >= 1000) )
        {
            $priceString = strval(intval($priceStringToReturn));
            if($isCommaTheDecimalSeparator)
            {
                return number_format($priceString, null, null, '.');
            }
            else
            {
                return number_format($priceString, null, null, ',');
            }
        }

        if( (!$isIntegerPriceUsed) && ($priceWithTwoDecimals >= 1000) )
        {
            $priceStringWithTwoDecimals = strval($priceWithTwoDecimals);
            $positionOfPeriod = strpos($priceStringWithTwoDecimals, '.');
            $priceStringInt = substr($priceStringWithTwoDecimals, 0, $positionOfPeriod);
            $decimalsString = substr($priceStringWithTwoDecimals, $positionOfPeriod + 1);

            if($isCommaTheDecimalSeparator)
            {
                $separatedPriceInt = number_format($priceStringInt, null, null, '.');
                return $separatedPriceInt . ',' . $decimalsString;
            }
            else
            {
                $separatedPriceInt = number_format($priceStringInt, null, null, ',');
                return $separatedPriceInt . '.' . $decimalsString;
            }
        }

        return $priceStringToReturn;
    }
    
    // Normal Price Format
    public static function getSetPriceFormatNormal($priceWithTwoDecimals)
    {
        $settings = Settings::first();
        $isCommaTheDecimalSeparator = $settings->comma_is_decimal_separator;
        $isIntegerPriceUsed = $settings->use_integer_prices;

        $priceStringToReturn = $priceWithTwoDecimals;
        if( ($isIntegerPriceUsed) && ($priceWithTwoDecimals < 1000) )
        {
            return intval($priceStringToReturn);
        }

        if( (!$isIntegerPriceUsed) && ($priceWithTwoDecimals < 1000) )
        {
            $priceString = strval($priceWithTwoDecimals);
            if($isCommaTheDecimalSeparator)
            {
                return str_replace('.', ',', $priceString);
            }
            else
            {
                return $priceStringToReturn;
            }
        }

        if( ($isIntegerPriceUsed) && ($priceWithTwoDecimals >= 1000) )
        {
            $priceString = strval(intval($priceStringToReturn));
            if($isCommaTheDecimalSeparator)
            {
                return number_format($priceString, null, null, '.');
            }
            else
            {
                return number_format($priceString, null, null, ',');
            }
        }

        if( (!$isIntegerPriceUsed) && ($priceWithTwoDecimals >= 1000) )
        {
            $priceStringWithTwoDecimals = strval($priceWithTwoDecimals);
            $positionOfPeriod = strpos($priceStringWithTwoDecimals, '.');
            $priceStringInt = substr($priceStringWithTwoDecimals, 0, $positionOfPeriod);
            $decimalsString = substr($priceStringWithTwoDecimals, $positionOfPeriod + 1);

            if($isCommaTheDecimalSeparator)
            {
                $separatedPriceInt = number_format($priceStringInt, null, null, '.');
                return $separatedPriceInt . ',' . $decimalsString;
            }
            else
            {
                $separatedPriceInt = number_format($priceStringInt, null, null, ',');
                return $separatedPriceInt . '.' . $decimalsString;
            }
        }

        return $priceStringToReturn;
    }

    // Get Currency String
    public static function getCurrencyString()
    {
        $settings = Settings::first();
        $currencyText = $settings->currency;
        $adjustedCurrencyText = $currencyText . ' ';
        if( $settings->use_currency_symbol == 1 )
        {
            if( $currencyText == 'USD' || $currencyText == 'EUR' || $currencyText == 'GBP'  )
            {
                $currencyData = Currency::where('name', $currencyText)->first();
                if( !is_null($currencyData) )
                {
                    $adjustedCurrencyText = $currencyData->symbol;
                }
            }
        }

        return $adjustedCurrencyText;
    }

    // Get Product Vat Rate
    public static function getVatRate($amount)
    {
        $settings = Settings::first();
        $isCommaTheDecimalSeparator = $settings->comma_is_decimal_separator;
        $isIntegerVatUsed = $settings->use_integer_prices;

        if($position = Location::get()):
            $countryCode = $position->countryCode;
        else:
            $countryCode = 'IT';
        endif;
        
        $vatCalculator = new VatCalculator();
        $vatCalculator->calculate($amount, strtolower($countryCode));

        // $taxRate  = $vatCalculator->getTaxRate();
        // $netPrice = $vatCalculator->getNetPrice();
        $amount   =  $vatCalculator->getTaxValue();

        $vatStringToReturn = $amount;
        if( ($isIntegerVatUsed) && ($amount < 1000) )
        {
            return intval($vatStringToReturn);
        }

        if( (!$isIntegerVatUsed) && ($amount < 1000) )
        {
            $vatString = strval($amount);
            if($isCommaTheDecimalSeparator)
            {
                return str_replace('.', ',', $vatString);
            }
            else
            {
                return $vatStringToReturn;
            }
        }

        if( ($isIntegerVatUsed) && ($amount >= 1000) )
        {
            $vatString = strval(intval($vatStringToReturn));
            if($isCommaTheDecimalSeparator)
            {
                return number_format($vatString, null, null, '.');
            }
            else
            {
                return number_format($vatString, null, null, ',');
            }
        }

        if( (!$isIntegerVatUsed) && ($amount >= 1000) )
        {
            $vatStringWithTwoDecimals = strval($amount);
            $positionOfPeriod = strpos($vatStringWithTwoDecimals, '.');
            $vatStringInt = substr($vatStringWithTwoDecimals, 0, $positionOfPeriod);
            $decimalsString = substr($vatStringWithTwoDecimals, $positionOfPeriod + 1);

            if($isCommaTheDecimalSeparator)
            {
                $separatedVatInt = number_format($vatStringInt, null, null, '.');
                return $separatedVatInt . ',' . $decimalsString;
            }
            else
            {
                $separatedVatInt = number_format($vatStringInt, null, null, ',');
                return $separatedVatInt . '.' . $decimalsString;
            }
        }

        return $vatStringToReturn;
    }
}
