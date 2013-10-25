<?php
/**
 * A view helper to get the current route
 */
namespace JmlHelpers\View\Helper;

use Zend\Mvc\Router\RouteInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Helper\AbstractHelper;
use Zend\View\HelperPluginManager;

class CurrentRoute extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function __invoke()
    {
        /** @var HelperPluginManager $pluginManager */
        $pluginManager = $this->getServiceLocator();
        $serviceManager = $pluginManager->getServiceLocator();

        /** @var RouteInterface $router */
        $router = $serviceManager->get('router');
        $request = $serviceManager->get('request');

        $routeMatch = $router->match($request);

        $matchedRoute = '';
        if (!is_null($routeMatch)) {
            $matchedRoute = $routeMatch->getMatchedRouteName();
        }
        return $matchedRoute;
    }
}
