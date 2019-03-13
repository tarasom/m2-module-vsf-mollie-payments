<?php

namespace GetNoticed\VsfMollie\Api;

use Magento\Sales\Api\Data\OrderInterface;
use GetNoticed\VsfMollie\Api\Data\MollieOrderInterface;

interface MollieOrderRepositoryInterface
{
    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     *
     * @return \GetNoticed\VsfMollie\Api\Data\MollieOrderInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getByOrder(OrderInterface $order): MollieOrderInterface;

    /**
     * @param \Magento\Sales\Api\Data\OrderInterface $order
     * @param string                                 $mollieTransactionId
     * @param string                                 $mollieSecretHash
     *
     * @return \GetNoticed\VsfMollie\Api\Data\MollieOrderInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        OrderInterface $order,
        string $mollieTransactionId,
        string $mollieSecretHash
    ): MollieOrderInterface;
}
