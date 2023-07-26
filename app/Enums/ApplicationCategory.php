<?php

namespace App\Enums;

enum ApplicationCategory: string {

    case RequestForInformation  = 'RequestForInformation';
    case RequestForAction  = 'RequestForAction';
    case RequestForService  = 'RequestForService';

}

