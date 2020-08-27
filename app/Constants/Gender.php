<?php

declare (strict_types = 1);

namespace App\Constants;

use App\Constants\BaseConstant;

class Gender extends BaseConstant
{
    const PRIA   = 1;
    const WANITA = 2;

    /**
     * Gender
     *
     * @return array
     */
    public static function labels(): array
    {
        return [
            self::PRIA   => 'Pria',
            self::WANITA => 'Wanita',
        ];
    }
}
