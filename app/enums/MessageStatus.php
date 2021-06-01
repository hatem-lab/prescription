<?php

namespace common\enums;

class MessageStatus extends PhpEnum {
    const NOT_DELIVERED = 0;
    const DELIVERED = 1;
    const SEEN = 2;
}
