# Lypto API

Laravel cryptocurrency trading APIs.

<a name="installation"></a>

## Installation

### Requirements

* Minimum Laravel version 7.0

Use the following command to install:

```bash
composer require obydul/lypto-api
```

Run the following command to publish config file:

```php
php artisan vendor:publish --provider="Obydul\LyptoAPI\LyptoAPIServiceProvider" --tag="config"
```

(Optional) Laravel 5.5 uses package auto-discovery, so doesn't require you to manually add the ServiceProvider. If you don't use auto-discovery,

```php
// add the service provider to your `$providers` array in `config/app.php` file
Obydul\LyptoAPI\LyptoAPIServiceProvider::class

// and add these lines to `$aliases` array
'Binance' => Obydul\LyptoAPI\Facades\Binance::class,
'TAAPI' =>Obydul\LyptoAPI\Facades\TAAPI::class,
```

Clear application config, cache (optional):

```php
php artisan optimize
```

Installation completed.

<a name="configuration"></a>

## Configuration

After installation, set API key and secret in the ```.env``` file.

```php
// exchange
LYPTO_API_MODE="sandbox" // sanbox or live
LYPTO_API_BINANCE_KEY="your-binane-api-key"
LYPTO_API_BINANCE_SECRET="your-binane-api-secret"

// tools
LYPTO_API_TAAPI_SECRET="your-taapi-secret"
```

<a name="exchanges"></a>

## Exchanges & Tools

### Exchanges

Supported exchanges and features:

| Exchange | Features
| --- | --- |
| Binance | Spot trade only

We will add more exchanges and APIs soon.

### Tools

Indicator API list:
| Name | Features |--- | --- | | TAAPI | Provides technical analysis indicator data

<a name="usage"></a>

## Usage

Create a Lypto request:

```php
use Obydul\LyptoAPI\Libraries\LyptoRequest;

$request = new LyptoRequest();
$request->param1 = 'Value 1';
$request->param2 = "Value 2";
$request->param2 = "Value 2";
```

Pass Laypto request to exchange's function:

```php
// exchange object
$exchange->functionName($request);

// exchange facade
Exchange::functionName($request);
```

### Binance

Take a look at [Binance APIs and parameters](https://binance-docs.github.io/apidocs/spot/en/#change-log).

```php
use Obydul\LyptoAPI\Exchanges\Binance;

// create a Binance object
$binance = new Binance();

// create order
$binance->createOrder($request);

// using facade
use Obydul\LyptoAPI\Facades\Binance;

Binance::createOrder($request);
```

Pass api key, secret & mode without .env file:

```php
$api_key = "YOUR_API_KEY";
$api_secret = "YOUR_API_SECRET";
$mode = "sandbox"; // default is live
$this->binance = new Binance($api_key, $api_secret, $mode); // mode doesn't need to pass for live
$this->binance = new Binance($api_key, $api_secret); // live

// using facade
use Obydul\LyptoAPI\Facades\Binance;
$account_info = Binance::config($api_key, $api_secret, $mode)->accountInfo(); // sandbox
$account_info = Binance::config($api_key, $api_secret)->accountInfo(); // live
```

Available methods:

| Title | Method
| --- | --- |
| Get current account information | accountInfo($request)
| Current price of a pair | currentPrice($request)
| Create order | createOrder($request)
| Cancel an active order | cancelOrder($request)
| Cancels all active orders on a symbol | cancelOpenOrders($request)
| Check an order's status | queryOrder($request)
| Get all open orders on a symbol| currentOpenOrders($request)
| Get all account orders; active, canceled, or filled | allOrders($request)
| Get trades for a specific account and symbol | accountTradeList($request)
| Create a new OCO | createOCO($request)
| Cancel an entire Order List | cancelOCO($request)
| Retrieves a specific OCO based on provided optional parameters | queryOCO($request)
| Retrieves all OCO based on provided optional parameters | queryAllOCO($request)
| Retrieves open OCO | queryOpenOCO($request)
| 24hr Ticker Price Change Statistics | priceChange24Hr($request
| Average price of a pair (5 mins) | avgPrice($request

### TAAPI

[TAAPI](https://taapi.io) provides technical analysis (TA) indicator data.

Let's have a look at the uasge:

```php
use Obydul\LyptoAPI\Tools\TAAPI;

$taapi = new TAAPI();
$request = new LyptoRequest();
$indicator_endpoint = "rsi";
$taapi->get($indicator_endpoint, $request);

// call via facade
use Obydul\LyptoAPI\Facades\TAAPI;

TAAPI::get($indicator_endpoint, $request);
```

Pass api key without .env file:

```php
$api_key = "YOUR_API_KEY";
$response = TAAPI::config($api_key)->get($indicator_endpoint, $request);
```

<a name="examples"></a>

## Examples

<details>
<summary>Binance</summary>

```php
use Obydul\LyptoAPI\Exchanges\Binance;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

private $binance;

/**
 * constructor.
 */
public function __construct()
{
    $this->binance = new Binance();
}

// account info
$account_info = $this->binance->accountInfo();
dd($account_info);

// account info using facade
use Obydul\LyptoAPI\Facades\Binance;

$account_info = Binance::accountInfo();
dd($account_info);

// create order
$request = new LyptoRequest();
$request->symbol = 'BTCUSDT';
$request->side = "SELL";
$request->type = "LIMIT";
$request->timeInForce = "GTC";
$request->quantity = 0.01;
$request->price = 9000;
$request->newClientOrderId = "my_order_id_1112";
$create_order = $this->binance->createOrder($request);
dd($create_order);

// account trade list
$request = new LyptoRequest();
$request->symbol = "BTCUSDT";
$trade_list = $this->binance->accountTradeList($request);
dd($trade_list);
```

</details>

<details>
<summary>TAAPI</summary>

```php
use Obydul\LyptoAPI\Facades\TAAPI;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

// lypto request
$request = new LyptoRequest();
$request->exchange = 'binance';
$request->symbol = "BTC/USDT";
$request->interval = "1h";

// indicator endpoint
$indicator_endpoint = "macd";

// get data
$response = TAAPI::get($indicator_endpoint, $request);

dd($response);
```

Output:

```php
array:3 [▼
  "valueMACD" => 289.32379962478
  "valueMACDSignal" => 257.39665148897
  "valueMACDHist" => 31.92714813581
]
````

</details>

<a name="information"></a>

## Information

- [Binance API doc](https://binance-docs.github.io/apidocs/spot/en/#change-log)
- [Binance test network](https://testnet.binance.vision)
- [TAAPI Doc](https://taapi.io/documentation)

<a name="license"></a>

## License

The MIT License (MIT). Please see [license file](https://github.com/mdobydullah/laraskrill/blob/master/LICENSE) for more information.

<a name="others"></a>

## Others

In case of any issues, kindly create one on the [Issues](https://github.com/mdobydullah/lypto-api/issues) section.

Thank you for installing LyptoAPI :heart:.
