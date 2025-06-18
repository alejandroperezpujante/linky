<?php

namespace App;

enum LinkStatus: string
{
    use EnumValues, SelectableEnum;

    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
