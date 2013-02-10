<?php

namespace Siphoc\PdfBundle\Tests\Util;

use Siphoc\PdfBundle\Util\JSToHTML;

class JSToHTMLTest extends \PHPUnit_Framework_TestCase
{
    public function test_constructor_with_basic_data()
    {
        $converter = new JSToHTML;
        $this->assertNull($converter->getBasePath());
    }

    public function test_it_stores_web_path()
    {
        $this->assertEquals(
            $this->getFixturesPath(),
            $this->getConverter()->getBasePath()
        );
    }

    public function test_it_extracts_javascript_files()
    {
        $converter = $this->getConverter();
        $htmlData = file_get_contents(
            $this->getFixturesPath() . '/javascript_test.html'
        );
        $jsFiles = $converter->extractExternalJavaScript($htmlData);

        $this->assertEquals(
            '<script src="/js/foo.js"></script>',
            $jsFiles['tags'][0]
        );
        $this->assertEquals(
            $this->getFixturesPath() . '/js/foo.js',
            $jsFiles['links'][0]
        );
        $this->assertEquals(
            'http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',
            $jsFiles['links'][1]
        );
    }

    private function getFixturesPath()
    {
        return __DIR__ . '/../Fixtures';
    }

    private function getConverter()
    {
        $converter = new JSToHTML;
        $converter->setBasePath($this->getFixturesPath());

        return $converter;
    }
}