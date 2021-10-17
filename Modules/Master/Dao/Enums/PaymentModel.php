<?php

namespace Modules\Master\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class PaymentModel extends Enum
{
    use StatusTrait;

    const PaymentModel          =  '';
    const DpSales               =  1;
    const PaymentSales          =  2;
    const DpCraftsman           =  3;
    const PaymentCraftsman      =  4;
    const DpForwarder           =  5;
    const PaymentForwarder      =  6;
    const PengeluaranLainnya    =  7;
    
    public static function colors()
    {
        return [
            self::PaymentModel => ColorType::Info,
            self::DpSales => ColorType::Brown,
            self::PaymentSales => ColorType::Primary,
            self::DpCraftsman => ColorType::Grey,
            self::PaymentCraftsman => ColorType::Success,
            self::DpForwarder => ColorType::Danger,
            self::PaymentForwarder => ColorType::Warning,
        ];
    }

    public static function name()
    {
        return 'Payment Status';
    }
}
