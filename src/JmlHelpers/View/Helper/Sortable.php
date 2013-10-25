<?php
/**
 * This helper can generate urls for sorting purpose.
 * I use it for my table headers coupled with a paginator
 */
namespace JmlHelpers\View\Helper;

use Zend\Http\Request;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\View\Helper\AbstractHelper;

class Sortable extends AbstractHelper implements ServiceLocatorAwareInterface
{
    use ServiceLocatorAwareTrait;

    public function __invoke($sort)
    {
        /** @var \Zend\View\HelperPluginManager $pluginManager */
        $pluginManager = $this->getServiceLocator();
        $serviceManager = $pluginManager->getServiceLocator();

        /** @var Request $request */
        $request = $serviceManager->get('request');

        $targetUrl = clone $request->getUri();
        $params = $targetUrl->getQueryAsArray();

        $oldSort = isset($params['sort']) ? $params['sort'] : '';
        $oldDirection = isset($params['direction']) ? $params['direction'] : '';

        $params['sort'] = trim($sort);

        if ($sort != $oldSort) {
            $params['direction'] = 'asc';
        } else {
            switch (strtolower($oldDirection)) {
                case '':
                    $params['direction'] = 'asc';
                    break;
                case 'asc':
                    $params['direction'] = 'desc';
                    break;
                default:
                    if (isset($params['direction'])) {
                        unset($params['direction']);
                    }
                    unset($params['sort']);
                    break;
            }
        }

        $targetUrl->setQuery($params);
        return $targetUrl->toString();
    }
}