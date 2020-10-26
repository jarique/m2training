<?php

namespace Training\Feedback\Controller\Index;

class Save extends \Magento\Framework\App\Action\Action
{
    /** @var \Training\Feedback\Model\FeedbackFactory */
    private $feedbackFactory;

    /** @var \Training\Feedback\Model\ResourceModel\Feedback */
    private $feedbackResource;

    /**
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Training\Feedback\Model\FeedbackFactory $feedbackFactory
     * @param \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Model\FeedbackFactory $feedbackFactory,
        \Training\Feedback\Model\ResourceModel\Feedback $feedbackResource
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackResource = $feedbackResource;

        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function execute()
    {
        $result = $this->resultRedirectFactory->create();

        if ($post = $this->getRequest()->getPostValue()) {
            try {
                $this->validatePost($post);
                $feedback = $this->feedbackFactory->create();
                $feedback->setData($post);
                $this->feedbackResource->save($feedback);

                $this->messageManager->addSuccessMessage(__('Thank you for your feedback'));
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage(
                    __('An error occurred while processing your form. Please try again later')
                );
                $result->setPath('*/*/form');
                return $result;
            }
        }

        $result->setPath('*/*/index');
        return $result;
    }

    /**
     * @param $post
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Exception
     */
    private function validatePost($post)
    {
        if (!isset($post['author_name']) || trim($post['author_name']) === '') {
            throw new \Magento\Framework\Exception\LocalizedException(__('Name is missing'));
        }
        if (!isset($post['message']) || trim($post['message']) === '') {
            throw new \Magento\Framework\Exception\LocalizedException(__('Comment is missing'));
        }
        if (!isset($post['author_email']) || false === \strpos($post['author_email'], '@')) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid email address'));
        }
        if (trim($this->getRequest()->getParam('hideit')) !== '') {
            throw new \Exception('Something went wrong');
        }
    }
}
