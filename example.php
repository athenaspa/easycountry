<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento senza titolo</title>
</head>

<body>
<?php
require "vendors/autoload.php";


// Report all PHP errors
error_reporting(-1);
// Same as error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
if (!defined('BASE_URL'))
  {
    define('BASE_URL', ($_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['SCRIPT_NAME']) . "/");
  }
if (!defined('API_KEY'))
  {
    define('API_KEY', '0ff28d5cc3a6e7475be5fa174703788fa155fc94');
  }
if (!defined('API_URL'))
  {
    define('API_URL', 'https://testapi.multisafepay.com/v1/json/'); //test is https://testapi.multisafepay.com/v1/json/, for live environment use https://api.multisafepay.com/v1/json/
  }
if (!defined('TOOLKIT_VERSION'))
  {
    define('TOOLKIT_VERSION', '2.0.0');
  }

$fastcheckout = new fastcheckout();
$fastcheckout->startTransaction();

class fastcheckout
  {

    private $api_key = '';
    private $api_url = '';

    function __construct()
      {
        $this->api_key = API_KEY;
        $this->api_url = API_URL;
      }

    function startTransaction()
      {

        $msp = new Msp\Client();
        $msp->setApiKey($this->api_key);
        $msp->setApiUrl($this->api_url);

	$countries = new Msp\Countries;
		
        try
          {

            $order_id = time();

            $order = $msp->orders->post(array(
                "type" => "checkout",
                "order_id" => $order_id,
                "currency" => "EUR",
                "amount" => 2000,
                "description" => "Demo Transaction",
                "var1" => "",
                "var2" => "",
                "var3" => "",
                "items" => "items list",
                "manual" => "false",
                "gateway" => "",
                "days_active" => "30",
                "payment_options" => array(
                    "notification_url" => BASE_URL . "notification.php",
                    "redirect_url" => BASE_URL . "complete.php",
                    "cancel_url" => BASE_URL . 'cancel.php',
                    "close_window" => "true"
                ),
                "customer" => array(
                    "locale" => "nl_NL",
                    "ip_address" => "127.0.0.1",
                    "forwarded_ip" => "127.0.0.1",
                    "first_name" => "Jan",
                    "last_name" => "Modaal",
                    "address1" => "Kraanspoor",
                    "address2" => "",
                    "house_number" => "39",
                    "zip_code" => "1032 SC",
                    "city" => "Amsterdam",
                    "state" => "",
                    "country" => $countries->getIdFromName("Netherlands"),
                    "phone" => "0208500500",
                    "email" => "test@test.nl"
                ),
                "gateway_info" => array(
                    "birthday" => "1980-01-30",
                    "bank_account" => "2884455",
                    "phone" => "0208500500",
                    "referrer" => "http://google.nl",
                    "user_agent" => "msp01"
                ),
                "shopping_cart" => array(
                    "items" => array(
                        array(
                            "name" => "Test",
                            "description" => "",
                            "unit_price" => "10",
                            "quantity" => "2",
                            "merchant_item_id" => "test123",
                            "tax_table_selector" => "BTW0",
                            "weight" => array(
                                "unit" => "KB",
                                "value" => "20"
                            )
                        )
                    )
                ),
                "checkout_options" => array(
                    "no-shipping-methods" => false,
                    "shipping_methods" => array(
                        "flat_rate_shipping" => array(
                            array(
                                "name" => "Post Nl - verzending NL",
                                "price" => "7",
                                "currency" => "",
                                "allowed_areas" => array(
                                    "NL"
                                )
                            ),
                            array(
                                "name" => "TNT verzending",
                                "price" => "9",
                                "excluded_areas" => array(
                                    "NL",
                                    "FR",
                                    "ES"
                                )
                            )
                        ),
                        "pickup" => array(
                            "name" => "Ophalen",
                            "price" => "0"
                        )
                    ),
                    "tax_tables" => array(
                        "default" => array(
                            "shipping_taxed" => "true",
                            "rate" => "0.21"
                        ),
                        "alternate" => array(
                            array(
                                "standalone" => "true",
                                "name" => "BTW0",
                                "rules" => array(
                                    array(
                                        "rate" => "0.00"
                                    )
                                )
                            )
                        )
                    )
                ),
                "custom_fields" => array(
                    array(
                        "standard_type" => "birthday"
                    ),
                    array(
                        "standard_type" => "companyname"
                    )
                ),
                "plugin" => array(
                    "shop" => "MultiSafepay Toolkit",
                    "shop_version" => TOOLKIT_VERSION,
                    "plugin_version" => TOOLKIT_VERSION,
                    "partner" => "MultiSafepay",
                    "shop_root_url" => "http://www.demo.nl"
                )
            ));

            header("Location: " . $msp->orders->getPaymentLink());
          }
        catch (Exception $e)
          {
            echo "Error " . htmlspecialchars($e->getMessage());
          }
      }
  }
?>
</body>
</html>
