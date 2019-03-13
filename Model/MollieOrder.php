<?php

namespace GetNoticed\VsfMollie\Model;

use Magento\Framework\{
    Model\AbstractModel,
    DataObject\IdentityInterface
};
use GetNoticed\VsfMollie\{
    Api\Data\MollieOrderInterface,
    Model\ResourceModel\MollieOrder as MollieOrderResource,
    Model\ResourceModel\MollieOrder\Collection as MollieOrderCollection
};

/**
 * @method MollieOrderResource getResource()
 * @method MollieOrderCollection getCollection()
 */
class MollieOrder extends AbstractModel implements MollieOrderInterface, IdentityInterface
{
    const CACHE_TAG = 'getnoticed_vsfmollie_mollieorder';

    protected $_cacheTag = 'getnoticed_vsfmollie_mollieorder';
    protected $_eventPrefix = 'getnoticed_vsfmollie_mollieorder';

    protected function _construct()
    {
        $this->_init(MollieOrderResource::class);
    }

    /**
     * @inheritdoc
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @inheritdoc
     */
    public function getOrderId(): int
    {
        return $this->getData('order_id');
    }

    /**
     * @inheritdoc
     */
    public function setOrderId(int $orderId): MollieOrderInterface
    {
        return $this->setData('order_id', $orderId);
    }

    /**
     * @inheritdoc
     */
    public function getMollieTransactionId(): string
    {
        return $this->getData('mollie_transaction_id');
    }

    /**
     * @inheritdoc
     */
    public function setMollieTransactionId(string $transactionId): MollieOrderInterface
    {
        return $this->setData('mollie_transaction_id', $transactionId);
    }

    /**
     * @inheritdoc
     */
    public function getMollieSecretHash(): string
    {
        return $this->getData('mollie_secret_hash');
    }

    /**
     * @inheritdoc
     */
    public function setMollieSecretHash(string $secretHash): MollieOrderInterface
    {
        return $this->setData('mollie_secret_hash', $secretHash);
    }

    /**
     * @inheritdoc
     */
    public function getCreatedAt(): string
    {
        return $this->getData('created_at');
    }

    /**
     * @inheritdoc
     */
    public function getUpdatedAt(): string
    {
        return $this->getData('updated_at');
    }
}
