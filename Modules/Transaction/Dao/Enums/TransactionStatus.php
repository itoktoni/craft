<?php

namespace Modules\Transaction\Dao\Enums;

use BenSampo\Enum\Enum;
use Modules\System\Dao\Enums\ColorType;
use Modules\System\Dao\Traits\StatusTrait;

class TransactionStatus extends Enum
{
    use StatusTrait;

    const Create            =  1;
    const Approve           =  2;
    const Process           =  3;
    const Complete          =  4;
    const Packaging         =  5;
    const Delivery           =  6;
    const Pending           =  7;
    const Finish            =  8;
    const Cancel            =  9;

    public static function colors()
    {
        return [
            self::Create => ColorType::Primary,
            self::Approve => ColorType::Primary,
            self::Process => ColorType::Primary,
            self::Complete => ColorType::Primary,
            self::Packaging => ColorType::Primary,
            self::Delivery => ColorType::Primary,
            self::Finish => ColorType::Primary,
            self::Cancel => ColorType::Primary,
            self::Pending => ColorType::Primary,
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
