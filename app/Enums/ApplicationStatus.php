<?php

namespace App\Enums;

enum ApplicationStatus: string {

    case processing  = 'processing';
    case attentionrequired  = 'attentionrequired';
    case approved  = 'approved';
    case rejected  = 'rejected';
    case processed  = 'processed';

}

