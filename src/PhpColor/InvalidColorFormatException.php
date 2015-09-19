<?php

namespace PhpColor;

class InvalidColorFormatException extends \Exception
{
    const BAD_COLOR_FORMAT = 'Bad color format';

    /**
     * Construct the exception.
     *
     * @param string $message [optional] The Exception message to throw.
     */
    public function __construct($message = '')
    {
        parent::__construct(self::BAD_COLOR_FORMAT);
    }
}
