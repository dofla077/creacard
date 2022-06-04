<?php

namespace App\Enums;

enum QuotationState: string
{
    case Accept = 'accept';
    case Reject = 'reject';
}
