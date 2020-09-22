<?php

namespace Training\Test\Observer;

use Magento\Customer\Model\Session;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\ActionFlag;
use Magento\Framework\App\Response\RedirectInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class RedirectToLogin implements ObserverInterface
{
    /**
     * @var RedirectInterface
     */
    private $redirect;

    /**
     * @var ActionFlag
     */
    private $actionFlag;

    /**
     * @var Session
     */
    private $customerSession;

    /**
     * @param RedirectInterface $redirect
     * @param ActionFlag $actionFlag
     * @param Session $customerSession
     */
    public function __construct(
        RedirectInterface $redirect,
        ActionFlag $actionFlag,
        Session $customerSession
    ) {
        $this->redirect = $redirect;
        $this->actionFlag = $actionFlag;
        $this->customerSession = $customerSession;
    }

    /**
     * @param Observer $observer
     */
    public function execute(Observer $observer)
    {
        if (!$this->customerSession->isLoggedIn()) {
            $controller = $observer->getEvent()->getData('controller_action');
            $this->actionFlag->set('', Action::FLAG_NO_DISPATCH, true);
            $this->redirect->redirect($controller->getResponse(), 'customer/account/login');
        }

        // $request = $observer->getEvent()->getData('request');
        // if ($request->getModuleName() == 'catalog'
        // && $request->getControllerName() == 'product'
        // && $request->getActionName() == 'view'
        // ) {}

        // if ($request->getFullActionName() == 'catalog_product_view') {} // altenative way
    }
}
