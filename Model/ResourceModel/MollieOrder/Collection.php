<?php

namespace GetNoticed\VsfMollie\Model\ResourceModel\MollieOrder;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use GetNoticed\VsfMollie\{
    Model\MollieOrder as MollieOrderModel,
    Model\ResourceModel\MollieOrder as MollieOrderResource
};

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(MollieOrderModel::class, MollieOrderResource::class);
    }
}
