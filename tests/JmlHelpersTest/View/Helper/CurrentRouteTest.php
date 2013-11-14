<?php

namespace JmlHelpersTest\View\Helper;

use PHPUnit_Framework_TestCase;
use JmlHelpers\View\Helper\CurrentRoute;
use Zend\Http\Request;
use Zend\Mvc\Router\SimpleRouteStack as Router;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;

class CurrentRouteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var HelperPluginManager
     */
    private $pluginManager;

    /**
     * @covers JmlHelpers\View\Helper\CurrentRoute
     */
    public function testCurrentRoute()
    {
        $helper = new CurrentRoute();
        $helper->setServiceLocator($this->pluginManager);

        $this->request->setUri('http://example.com');
        $url = $helper->__invoke();
        $this->assertEquals($url, 'home');

        $this->request->setUri('http://example.com/foo/bar');
        $url = $helper->__invoke();
        $this->assertEquals($url, 'default');

        $this->request->setUri('http://example.com/foo');
        $url = $helper->__invoke();
        $this->assertEquals($url, 'default');

        $this->request->setUri('http://example.com/foo/bar/baz');
        $url = $helper->__invoke();
        $this->assertEquals($url, '');
    }

    protected function setUp()
    {
        $router = new Router();
        $router->addRoute('home', array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
            )
        ));
        $router->addRoute('default', array(
            'type' => 'Zend\Mvc\Router\Http\Segment',
            'options' => array(
                'route' => '/:controller[/:action]',
            )
        ));

        $this->request = new Request();

        $serviceManager = new ServiceManager();
        $serviceManager->setService('router', $router);
        $serviceManager->setService('request', $this->request);

        $pluginManager = new HelperPluginManager();
        $pluginManager->setServiceLocator($serviceManager);

        $this->pluginManager = $pluginManager;
    }
}
