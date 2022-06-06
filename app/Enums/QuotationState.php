<?php

namespace App\Enums;

enum QuotationState: string
{
    case NotDefined = 'not defined';
    case Accept = 'accept';
    case Reject = 'reject';
}
