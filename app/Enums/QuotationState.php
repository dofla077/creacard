<?php

namespace App\Enums;

enum QuotationState: string
{
    case NotDefined = 'not defined';
    case Pending = 'pending';
    case Accept = 'accept';
    case Reject = 'reject';
}
