<?php

namespace Modules\Transaction\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class ServiceStatus extends Enum
{
    use StatusTrait;

    const Create            =  1;
    const DownPayment       =  2;
    const Process           =  3;
    const Complete          =  4;
    const Template          =  5;

    public static function colors()
    {
        return [
            self::Create => ColorType::Primary,
            self::DownPayment => ColorType::Primary,
            self::Process => ColorType::Primary,
            self::Complete => ColorType::Primary,
            self::Template => ColorType::Primary,
        ];
    }

    public static function name()
    {
        return 'Linen Status';
    }

    public static function getDescription($value): string
    {
        return parent::getDescription($value);
    }
}
