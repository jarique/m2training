<?php

namespace Training\Test\App\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\NoRouteHandlerInterface;

class NoRouteHandler implements NoRouteHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function process(RequestInterface $request)
    {
        $moduleName = 'cms';
        $controllerPath = 'index';
        $controllerName = 'index';
        $request->setModuleName($moduleName)
            ->setControllerName($controllerPath)
            ->setActionName($controllerName);

        return true;
    }
}
