<?php

namespace Obydul\LyptoAPI\Exchanges;

use Obydul\LyptoAPI\Libraries\KuCoin\KuCoinCommon;
use Obydul\LyptoAPI\Libraries\KuCoin\KuCoinSpot;
use Obydul\LyptoAPI\Libraries\KuCoin\KuCoinTicker;

class KuCoin
{
    use KuCoinCommon, KuCoinSpot, KuCoinTicker;
}
