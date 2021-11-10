<?php

namespace Modules\Master\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class VendorType extends Enum
{
    use StatusTrait;

    const TYPE                  =  null;
    const Receiver              =  1;
    const Shipper               =  2;
    const Consignee             =  3;
    const Agent                 =  4;
    const NotifyParty                =  5;

    public static function colors()
    {
        return [
            self::TYPE => ColorType::Primary,
            self::Receiver => ColorType::Success,
            self::Shipper => ColorType::Danger,
            self::Consignee => ColorType::Danger,
            self::Agent => ColorType::Danger,
            self::NotifyParty => ColorType::Danger,
        ];
    }

    public static function name()
    {
        return 'Payment Status';
    }
}
