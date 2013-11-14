<?php

namespace JmlHelpersTest\View\Helper;

use PHPUnit_Framework_TestCase;
use JmlHelpers\View\Helper\Sortable;
use Zend\Http\Request;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;

class SortableTest extends PHPUnit_Framework_TestCase
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
     * @var Sortable
     */
    private $helper;

    /**
     * @covers JmlHelpers\View\Helper\Sortable
     */
    public function testSortable()
    {
        $this->request->setUri('http://example.com');
        $url = $this->helper->__invoke('foo');
        $this->assertEquals($url, 'http://example.com/?sort=foo&direction=asc');

        $this->request->setUri('http://example.com?sort=foo');
        $url = $this->helper->__invoke('foo');
        $this->assertEquals($url, 'http://example.com/?sort=foo&direction=asc');

        $this->request->setUri('http://example.com?sort=foo&direction=asc');
        $url = $this->helper->__invoke('foo');
        $this->assertEquals($url, 'http://example.com/?sort=foo&direction=desc');

        $this->request->setUri('http://example.com?sort=foo&direction=desc');
        $url = $this->helper->__invoke('foo');
        $this->assertEquals($url, 'http://example.com/');

        $this->request->setUri('http://example.com?sort=foo&direction=asc');
        $url = $this->helper->__invoke('baz');
        $this->assertEquals($url, 'http://example.com/?sort=baz&direction=asc');

        $this->request->setUri('http://example.com?sort=foo&direction=desc');
        $url = $this->helper->__invoke('baz');
        $this->assertEquals($url, 'http://example.com/?sort=baz&direction=asc');
    }

    protected function setUp()
    {
        $this->request = new Request();

        $serviceManager = new ServiceManager();
        $serviceManager->setService('request', $this->request);

        $pluginManager = new HelperPluginManager();
        $pluginManager->setServiceLocator($serviceManager);

        $this->pluginManager = $pluginManager;

        $helper = new Sortable();
        $helper->setServiceLocator($this->pluginManager);
        $this->helper = $helper;
    }
}
