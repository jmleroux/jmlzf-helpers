<?php
/**
 * A very simple helper to get query params as an array
 */
namespace JmlHelpers\View\Helper;

use Zend\Http\Request;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Helper\AbstractHelper;

class QueryParams extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function __invoke()
    {
        /** @var \Zend\View\HelperPluginManager $pluginManager */
        $pluginManager = $this->getServiceLocator();
        $serviceManager = $pluginManager->getServiceLocator();
        /** @var Request $request */
        $request = $serviceManager->get('request');
        return $request->getUri()->getQueryAsArray();
    }
}
