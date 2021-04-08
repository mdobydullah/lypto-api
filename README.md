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

Laravel 5.5 uses package auto-discovery, so doesn't require you to manually add the ServiceProvider. If you don't use auto-discovery, add the service provider to your `$providers` array in `config/app.php` file like:

```php
Obydul\LyptoAPI\LyptoAPIServiceProvider::class
```

Run the following command to publish configuration:

```php
php artisan vendor:publish --provider="Obydul\LyptoAPI\LyptoAPIServiceProvider" --tag="config"
```

Clear application config, cache (optional):

```php
php artisan optimize
```

Installation completed.

<a name="configuration"></a>

## Configuration

After installation, set API key and secret in the environment eariables.

```php
LYPTO_API_MODE="sandbox" // sanbox or live
LYPTO_API_BINANCE_KEY="your-binane-api-key"
LYPTO_API_BINANCE_SECRET="your-binane-api-secret"
```

<a name="exchanges"></a>

## Exchanges

Supported exchanges and features:

| Exchange | Features
| --- | --- |
| Binance | Spot trade only

We will add more exchanges and APIs soon.

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
$exchange->functionName($request);
```

### Binance

Take a look at [Binance APIs and parameters](https://binance-docs.github.io/apidocs/spot/en/#change-log).

```php
use Obydul\LyptoAPI\Exchanges\Binance;

// create a Binance object
$binance = new Binance();

// create order
$binance->createOrder($request);
```

Available Binace methods:

| Title | Method
| --- | --- |
| Create order | createOrder($request)
| Cancel an active order | cancelOrder($request)
| Cancels all active orders on a symbol | cancelOpenOrders($request)
| Check an order's status | queryOrder($request)
| Get all open orders on a symbol| currentOpenOrders($request)
| Get all account orders; active, canceled, or filled | allOrders($request)
| Get current account information | accountInfo($request)
| Get trades for a specific account and symbol | accountTradeList($request)

<a name="examples"></a>

## Examples

<details>
<summary>Binance</summary>

```php
use Obydul\LyptoAPI\Exchanges\Binance;
use Obydul\LyptoAPI\Libraries\LyptoRequest;

private static $binance;

/**
 * constructor.
 */
public function __construct()
{
    self::$binance = new Binance();
}

// account info
$account_info = self::$binance->accountInfo();
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
$create_order = self::$binance->createOrder($request);
dd($create_order);

// account trade list
$request = new LyptoRequest();
$request->symbol = "BTCUSDT";
$trade_list = self::$binance->accountTradeList($request);
dd($trade_list);
```

</details>

<a name="information"></a>

## Information

- [Binance API docs](https://binance-docs.github.io/apidocs/spot/en/#change-log)
- [Binance test network](https://testnet.binance.vision/)

<a name="license"></a>

## License

The MIT License (MIT). Please see [license file](https://github.com/mdobydullah/laraskrill/blob/master/LICENSE) for more information.

<a name="others"></a>

## Others

In case of any issues, kindly create one on the [Issues](https://github.com/mdobydullah/lypto-api/issues) section.

Thank you for installing LyptoAPI :heart:.
