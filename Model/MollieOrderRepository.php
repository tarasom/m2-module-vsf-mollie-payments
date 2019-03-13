<?php

namespace GetNoticed\VsfMollie\Model;

use Magento\Framework\{Exception\LocalizedException, Exception\NoSuchEntityException};
use Magento\Sales\{
    Api\Data\OrderInterface,
    Model\Order
};
use GetNoticed\VsfMollie\{
    Api\MollieOrderRepositoryInterface,
    Api\Data\MollieOrderInterface,
    Model\MollieOrderFactory as MollieOrderFactory,
    Model\ResourceModel\MollieOrder as MollieOrderResource
};

class MollieOrderRepository implements MollieOrderRepositoryInterface
{
    /**
     * @var MollieOrderFactory
     */
    private $entityFactory;

    /**
     * @var MollieOrderResource
     */
    private $resource;

    public function __construct(
        MollieOrderFactory $entityFactory,
        MollieOrderResource $resource
    ) {
        $this->entityFactory = $entityFactory;
        $this->resource = $resource;
    }

    /**
     * @inheritdoc
     *
     * @param OrderInterface|Order $order
     */
    public function getByOrder(OrderInterface $order): MollieOrderInterface
    {
        $mollieOrder = $this->createEntityInstance();
        $this->resource->load($mollieOrder, $order->getId(), 'order_id');

        if ($mollieOrder->getId() === null) {
            throw NoSuchEntityException::singleField('order_id', $order->getId());
        }

        return $mollieOrder;
    }

    /**
     * @inheritdoc
     *
     * @param OrderInterface|Order $order
     */
    public function save(
        OrderInterface $order,
        string $mollieTransactionId,
        string $mollieSecretHash
    ): MollieOrderInterface {
        try {
            $mollieOrder = $this->getByOrder($order);
        } catch (NoSuchEntityException $e) {
            $mollieOrder = $this->createEntityInstance();
            $mollieOrder->setOrderId($order->getId());
        }

        $mollieOrder->setMollieTransactionId($mollieTransactionId)->setMollieSecretHash($mollieSecretHash);

        try {
            $this->resource->save($mollieOrder);
        } catch (\Exception $e) {
            throw new LocalizedException(__('Unable to save Mollie order payment data: %1', $e->getMessage()));
        }

        // Force a reload so we have a fresh object to use
        return $this->getByOrder($order);
    }

    /**
     * @return \GetNoticed\VsfMollie\Model\MollieOrder
     */
    protected function createEntityInstance(): MollieOrder
    {
        return $this->entityFactory->create();
    }
}
