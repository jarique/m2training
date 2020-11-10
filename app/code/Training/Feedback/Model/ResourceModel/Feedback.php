<?php

namespace Training\Feedback\Model\ResourceModel;

class Feedback extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    const TABLE_NAME = 'training_feedback';

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, \Training\Feedback\Api\Data\FeedbackInterface::FEEDBACK_ID);
    }

    /**
     * @return string
     */
    public function getAllFeedbackNumber()
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from(self::TABLE_NAME, new \Zend_Db_Expr('COUNT(*)'));
        return $adapter->fetchOne($select);
    }

    /**
     * @return string
     */
    public function getActiveFeedbackNumber()
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from(self::TABLE_NAME, new \Zend_Db_Expr('COUNT(*)'))
            ->where('is_active = ?', \Training\Feedback\Model\Feedback::STATUS_ACTIVE);
        return $adapter->fetchOne($select);
    }
}
