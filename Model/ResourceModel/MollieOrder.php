<?php

namespace GetNoticed\VsfMollie\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class MollieOrder extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('gn_vsf_mollie_order', 'entity_id');
    }
}
