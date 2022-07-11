<?php

namespace Route\Route;

class HttpErrorRoute
{
    private int $httpErrorCode;
    private string $httpErrorMessage;

    /**
     * @var int $httpErrorCode
     * @var string $httpErrorMessage
     */
    public function __construct(int $httpErrorCode, string $httpErrorMessage)
    {
        $this->httpErrorCode = $httpErrorCode;
        $this->httpErrorMessage = $httpErrorMessage;
    }

	/**
	 * @return string
	 */
	function getHttpErrorMessage(): string
    {
		return $this->httpErrorMessage;
	}

    /**
	 * @return int
	 */
	function getHttpErrorCode(): int
    {
		return $this->httpErrorCode;
	}
}
