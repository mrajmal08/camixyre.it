<?php

namespace App\Helpers;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use Stevebauman\Location\Facades\Location;
use Mpociot\VatCalculator\VatCalculator;
use Illuminate\Http\Request;
use Session;
use Cookie;
use Auth;
use DB;

class PayPalSdkHelper
{
    public static function client()
    {
        return new PayPalHttpClient(self::environment());
    }

    public static function environment()
    {
        $payPalSettings = DB::table('paypal_settings')->first();
        if(is_null($payPalSettings))
        {
            return null;
        }

        $clientId = '';
        $clientSecret = '';
        if($payPalSettings->paypal_smart_environment == 'sandbox')
        {
            $clientId = $payPalSettings->paypal_smart_sandbox_client;
            $clientSecret = $payPalSettings->paypal_smart_sandbox_secret;
            return new SandboxEnvironment($clientId, $clientSecret);
        }
        else
        {
            $clientId = $payPalSettings->paypal_smart_production_client;
            $clientSecret = $payPalSettings->paypal_smart_production_secret;
            return new ProductionEnvironment($clientId, $clientSecret);
        }
    }

    public static function createOrder($setCurrency, $clientDetails)
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');

        // Create Items Structure Start
        if($authUser = Auth::user()):
            $userID = $authUser->id;
        else:
            $userID = Cookie::get('guestUser');
        endif;

        $cartList       = DB::table('cart')->where('user_id', $userID)->where('status', 'in_cart')->get();
        $cartProducts   = DB::table('products')->get();
        $cartAttributes = DB::table('attributes')->get();

        $dataProducts    = array();
        $grandTotalAm    = array();
        $subTotalItems   = array();
        $shippingCharges = array();
        $vatTotal        = array();

        foreach($cartList as $cart):
          $num = 0;
            foreach($cartProducts as $product):
                if($product->id == $cart->product_id):
                
                    $productAttributeNames = "";

                    // Get Attributes Data
                    $incPrice = 0.00;
                    if($cart->product_attributes != "default"):
                        foreach($cartAttributes as $attribute):
                            $arrtIds = explode('|', $cart->product_attributes);
                            foreach($arrtIds as $attrId):
                                if($attribute->id == $attrId):
                                    $productAttributeNames .= $attribute->name_en . ", ";
                                    $incPrice += $attribute->price;
                                endif;
                            endforeach;
                        endforeach;
                    else:
                        $productAttributeNames = "Default";
                    endif;

                    // Get Prices
                    $discountPrice = $product->discount_price;
                    $normalPrice   = $product->price;
                    
                    if($product->on_sale == TRUE && $discountPrice < $normalPrice && $discountPrice > 0):
                        $subTotalItems[] = ($discountPrice + $incPrice) * $cart->quantity;
                        $grandTotalAm[]  = ($discountPrice + $incPrice) * $cart->quantity;
                        $price           = $discountPrice  + $incPrice;
                    else:
                        $subTotalItems[] = ($normalPrice + $incPrice) * $cart->quantity;
                        $grandTotalAm[]  = ($normalPrice + $incPrice) * $cart->quantity;
                        $price           = $normalPrice  + $incPrice;
                    endif;

                    // Get Shipping Charges
                    $shippingCharges[] = $product->shipping_price;
                    $grandTotalAm[]    = $product->shipping_price;

                    // Get Tax Rate
                    if($position = Location::get()):
                        $countryCode = $position->countryCode;
                    else:
                        $countryCode = 'IT';
                    endif;
                    
                    $vatCalculator = new VatCalculator();
                    $vatCalculator->calculate($price, strtolower($countryCode));
                    $grandTotalAm[] = $vatCalculator->getTaxValue();
                    $vatTotal[]     = $vatCalculator->getTaxValue();
                    $vatPrice       = $vatCalculator->getTaxValue();

                    // Order Items Structure
                    $dataProducts[] = array(
                        'name' => $product->title_en,
                        'description' => $productAttributeNames,
                        'sku' => $cart->product_sku,
                        'unit_amount' =>
                        array(
                            'currency_code' => $setCurrency,
                            'value' => $price,
                        ),
                        'tax' =>
                        array(
                            'currency_code' => $setCurrency,
                            'value' => $vatPrice,
                        ),
                        'quantity' => $cart->quantity,
                        'category' => 'PHYSICAL_GOODS',
                    );

                    $num++;
                endif;
            endforeach;
        endforeach;

        // Grand Total Items Amount
        $grandTotalAmount = array_sum($grandTotalAm);
        $grandTotalItems  = array_sum($subTotalItems);
        $shippingTotal    = array_sum($shippingCharges);
        $taxTotal         = array_sum($vatTotal);
        // Create Items Structure End

        $request->body = self::buildRequestBody($setCurrency, $dataProducts, $grandTotalItems, $grandTotalAmount, $shippingTotal, $taxTotal, $clientDetails);

        $client = self::client();
        $response = $client->execute($request);

        return response()->json([$response]);
    }

    private static function buildRequestBody($setCurrency, $dataProducts, $grandTotalItems, $grandTotalAmount, $shippingTotal, $taxTotal, $clientDetails)
    {
        // $adjustedTotal = self::adjustPaypalAmount($setCurrency, $total);

        // echo "<pre>";
        // echo $totalAmount;
        // print_r($dataProducts);
        // echo "</pre>";

        // Order ID
        $digits = 4;
        $orderID = rand(pow(10, $digits-1), pow(10, $digits)-1);

        // Shipping Details
        $firstName = $clientDetails['first_name'];
        $lastName  = $clientDetails['last_name'];
        $street    = $clientDetails['street'];
        $apartment = $clientDetails['apartment'];
        $phone     = $clientDetails['phone'];
        $city      = $clientDetails['city'];
        $state     = $clientDetails['state'];
        $country   = $clientDetails['country'];
        $zip       = $clientDetails['zip'];
  
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
              array(
                'brand_name' => 'ONECLOD',
                'locale' => 'en-US',
                'landing_page' => 'BILLING',
                'shipping_preference' => 'SET_PROVIDED_ADDRESS',
                'user_action' => 'PAY_NOW',
              ),
            'purchase_units' =>
              array(
                0 =>
                  array(
                    'reference_id' => $orderID,
                    'description' => 'Kitchen Wears',
                    'custom_id' => 'CUST-'.$orderID,
                    'soft_descriptor' => 'KitchenWears',
                    'amount' =>
                      array(
                        'currency_code' => $setCurrency,
                        'value' => $grandTotalAmount,
                        'breakdown' =>
                          array(
                            'item_total' =>
                              array(
                                'currency_code' => $setCurrency,
                                'value' => $grandTotalItems,
                              ),
                            'shipping' =>
                              array(
                                'currency_code' => $setCurrency,
                                'value' => $shippingTotal,
                              ),
                            'handling' =>
                              array(
                                'currency_code' => $setCurrency,
                                'value' => '0.00',
                              ),
                            'tax_total' =>
                              array(
                                'currency_code' => $setCurrency,
                                'value' => $taxTotal,
                              ),
                            'shipping_discount' =>
                              array(
                                'currency_code' => $setCurrency,
                                'value' => '0.00',
                              ),
                          ),
                      ),
                    'items' =>
                      $dataProducts,
                    'shipping' =>
                      array(
                        'method' => 'OneClod Postal Service',
                        'address' =>
                          array(
                            'address_line_1' => $street,
                            'address_line_2' => $apartment,
                            'admin_area_2' => $city,
                            'admin_area_1' => $state,
                            'postal_code' => $zip,
                            'country_code' => $country,
                          ),
                      ),
                  ),
              ),
          );

    }

    public static function captureOrder($orderId)
    {
        $request = new OrdersCaptureRequest($orderId);
        $client = self::client();
        $response = $client->execute($request);

        return response()->json([$response]);
    }

    public static function adjustPaypalAmount($paypalCurrency, $amountForPaypal)
    {
        if( ($paypalCurrency == "HUF") || ($paypalCurrency == "JPY") || ($paypalCurrency == "TWD") )
        {
            return intval($amountForPaypal);
        }

        return $amountForPaypal;
    }
}
