<?php

namespace GetNoticed\VsfMollie\Plugin;

use Magento\Framework\{
    Exception\NoSuchEntityException
};
use Magento\Sales\{
    Api\OrderRepositoryInterface,
    Api\Data\OrderInterface
};
use GetNoticed\VsfMollie\{
    Api\MollieOrderRepositoryInterface
};

class OrderExtensionAttributes
{
    /**
     * @var MollieOrderRepositoryInterface
     */
    private $mollieOrderRepository;

    public function __construct(
        MollieOrderRepositoryInterface $mollieOrderRepository
    ) {
        $this->mollieOrderRepository = $mollieOrderRepository;
    }

    public function afterGet(
        OrderRepositoryInterface $subject,
        OrderInterface $order,
        int $id
    ) {
        $extensionAttributes = $order->getExtensionAttributes();

        try {
            $mollieOrder = $this->mollieOrderRepository->getByOrder($order);
            $extensionAttributes->setGnVsfMollieOrder($mollieOrder);

            $order->setMollieTransactionId($mollieOrder->getMollieTransactionId());
            return $order;
        } catch (NoSuchEntityException $e) {
            // No Mollie data, return original order without further action
            return $order;
        }
    }
}
