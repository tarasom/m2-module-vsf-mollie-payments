<?php

namespace GetNoticed\VsfMollie\Api\Data;

interface MollieOrderInterface
{
    /**
     * @return int|null
     */
    public function getId();

    /**
     * @return int
     */
    public function getOrderId(): int;

    /**
     * @param int $orderId
     *
     * @return \GetNoticed\VsfMollie\Api\Data\MollieOrderInterface
     */
    public function setOrderId(int $orderId): self;

    /**
     * @return string
     */
    public function getMollieTransactionId(): string;

    /**
     * @param string $transactionId
     *
     * @return \GetNoticed\VsfMollie\Api\Data\MollieOrderInterface
     */
    public function setMollieTransactionId(string $transactionId): self;

    /**
     * @return string
     */
    public function getMollieSecretHash(): string;

    /**
     * @param string $secretHash
     *
     * @return \GetNoticed\VsfMollie\Api\Data\MollieOrderInterface
     */
    public function setMollieSecretHash(string $secretHash): self;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;
}
