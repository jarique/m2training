<?php

namespace Training\Feedback\Api\Data;

interface FeedbackInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    const FEEDBACK_ID  = 'feedback_id';
    const AUTHOR_NAME  = 'author_name';
    const AUTHOR_EMAIL = 'author_email';
    const MESSAGE      = 'message';
    const CREATE_TIME  = 'create_time';
    const UPDATE_TIME  = 'update_time';
    const IS_ACTIVE    = 'is_active';

    /**
     * Get author name
     *
     * @return string|null
     */
    public function getAuthorName();

    /**
     * Get author email
     *
     * @return string|null
     */
    public function getAuthorEmail();

    /**
     * Get message
     *
     * @return string|null
     */
    public function getMessage();

    /**
     * Get create time
     *
     * @return string|null
     */
    public function getCreateTime();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getUpdateTime();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function isActive();

    /**
     * Set author name
     *
     * @param string $authorName
     * @return FeedbackInterface
     */
    public function setAuthorName(string $authorName);

    /**
     * Set author email
     *
     * @param string $authorEmail
     * @return FeedbackInterface
     */
    public function setAuthorEmail(string $authorEmail);

    /**
     * Set message
     *
     * @param string $message
     * @return FeedbackInterface
     */
    public function setMessage(string $message);

    /**
     * Set create time
     *
     * @param string $createTime
     * @return FeedbackInterface
     */
    public function setCreateTime(string $createTime);

    /**
     * Set update time
     *
     * @param string $updateTime
     * @return FeedbackInterface
     */
    public function setUpdateTime(string $updateTime);

    /**
     * Set is active
     *
     * @param bool|int $isActive
     * @return FeedbackInterface
     */
    public function setIsActive($isActive);

    /**
     * Retrieve existing extension attributes object
     *
     * @return \Training\Feedback\Api\Data\FeedbackExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object
     *
     * @param \Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\Training\Feedback\Api\Data\FeedbackExtensionInterface $extensionAttributes);
}
