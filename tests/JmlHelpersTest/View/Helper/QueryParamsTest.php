<?php

namespace JmlHelpersTest\View\Helper;

use PHPUnit_Framework_TestCase;
use JmlHelpers\View\Helper\QueryParams;
use Zend\Http\Request;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;

class QueryTest extends PHPUnit_Framework_TestCase
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
     * @covers Query
     */
    public function testQuery()
    {
        $helper = new QueryParams();
        $helper->setServiceLocator($this->pluginManager);

        $this->request->setUri('http://example.com');
        $values = $helper->__invoke();
        $this->assertEquals($values, array());

        $this->request->setUri('http://example.com?foo=bar&snafu=baz');
        $values = $helper->__invoke();
        $this->assertEquals($values, array(
            'foo' => 'bar',
            'snafu' => 'baz'
        ));
        $this->request->setUri('http://example.com?foo=&snafu=baz');
        $values = $helper->__invoke();
        $this->assertEquals($values, array(
            'foo' => '',
            'snafu' => 'baz'
        ));
    }

    protected function setUp()
    {
        $this->request = new Request();

        $serviceManager = new ServiceManager();
        $serviceManager->setService('request', $this->request);

        $pluginManager = new HelperPluginManager();
        $pluginManager->setServiceLocator($serviceManager);

        $this->pluginManager = $pluginManager;
    }
}
