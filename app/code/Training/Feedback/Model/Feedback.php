<?php

namespace Training\Feedback\Model;

class Feedback extends \Magento\Framework\Model\AbstractExtensibleModel implements \Training\Feedback\Api\Data\FeedbackInterface
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $_eventPrefix = 'training_feedback';
    protected $_eventObject = 'feedback';

    protected function _construct()
    {
        $this->_init(\Training\Feedback\Model\ResourceModel\Feedback::class);
    }

    /**
     * Get author name
     *
     * @return string
     */
    public function getAuthorName()
    {
        return $this->getData(self::AUTHOR_NAME);
    }

    /**
     * Get author email
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->getData(self::AUTHOR_EMAIL);
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->getData(self::MESSAGE);
    }

    /**
     * Retrieve post create time
     *
     * @return string
     */
    public function getCreateTime()
    {
        return $this->getData(self::CREATE_TIME);
    }

    /**
     * Retrieve post update time
     *
     * @return string
     */
    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }

    /**
     * Is active
     *
     * @return bool
     */
    public function isActive()
    {
        return (bool)$this->getData(self::IS_ACTIVE);
    }

    /**
     * Set author name
     *
     * @param string $authorName
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     */
    public function setAuthorName(string $authorName)
    {
        return $this->setData(self::AUTHOR_NAME, $authorName);
    }

    /**
     * Set author email
     *
     * @param string $authorEmail
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     */
    public function setAuthorEmail(string $authorEmail)
    {
        return $this->setData(self::AUTHOR_EMAIL, $authorEmail);
    }

    /**
     * Set message
     *
     * @param string $message
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     */
    public function setMessage(string $message)
    {
        return $this->setData(self::MESSAGE, $message);
    }

    /**
     * Set create time
     *
     * @param string $createTime
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     */
    public function setCreateTime(string $createTime)
    {
        return $this->setData(self::CREATE_TIME, $createTime);
    }

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     */
    public function setUpdateTime(string $updateTime)
    {
        return $this->setData(self::UPDATE_TIME, $updateTime);
    }

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return \Training\Feedback\Api\Data\FeedbackInterface
     */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     */
    public function setExtensionAttributes(\Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
