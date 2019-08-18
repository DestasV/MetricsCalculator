<?php

namespace Supermetrics\ValueObject;

class User {
    /**
     * @var string
     */
    private $clientId;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var Token
     */
    private $token;

    /**
     * User constructor.
     *
     * @param string $clientId
     * @param string $name
     * @param string $email
     * @param Token  $token
     */
    public function __construct(string $clientId, string $name, string $email, Token $token = null)
    {
        $this->clientId = $clientId;
        $this->name = $name;
        $this->email = $email;
        $this->token = $token;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     *
     * @return $this
     */
    public function setClientId(string $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Token|null
     */
    public function getToken(): ?Token
    {
        return $this->token;
    }

    /**
     * @param Token $token
     *
     * @return $this
     */
    public function setToken(Token $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return array
     */
    public function getCredentials(): array
    {
        return [
            'client_id' => $this->clientId,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}