<?php

namespace Supermetrics\ValueObject;

class Token
{
    /**
     * @var string|null
     */
    private $token;

    /**
     * Token constructor.
     *
     * @param string $token
     */
    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     *
     * @return $this
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }
}