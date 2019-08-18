<?php

namespace Supermetrics\ValueObject;

class Post
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $fromId;
    /**
     * @var string
     */
    private $fromName;
    /**
     * @var string
     */
    private $type;
    /**
     * @var \DateTime
     */
    private $createdAt;
    /**
     * @var string
     */
    private $message;

    /**
     * Post constructor.
     *
     * @param string $id
     * @param string $fromId
     * @param string $fromName
     * @param string $type
     * @param \DateTime $createdAt
     * @param string $message
     */
    public function __construct(
        string $id,
        string $fromId,
        string $fromName,
        string $type,
        \DateTime $createdAt,
        string $message
    ) {
        $this->id = $id;
        $this->fromId = $fromId;
        $this->fromName = $fromName;
        $this->type = $type;
        $this->createdAt = $createdAt;
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return $this
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromId(): string
    {
        return $this->fromId;
    }

    /**
     * @param string $fromId
     *
     * @return $this
     */
    public function setFromId(string $fromId): self
    {
        $this->fromId = $fromId;

        return $this;
    }

    /**
     * @return string
     */
    public function getFromName(): string
    {
        return $this->fromName;
    }

    /**
     * @param string $fromName
     *
     * @return $this
     */
    public function setFromName(string $fromName): self
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     *
     * @return $this
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

}