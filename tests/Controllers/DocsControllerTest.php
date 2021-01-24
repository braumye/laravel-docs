<?php

namespace Braumye\LaravelDocs\Tests\Controllers;

use Braumye\LaravelDocs\Tests\TestCase;

class DocsControllerTest extends TestCase
{
    /** @test */
    public function render_default_page()
    {
        $this->putReadmeDocs();
        $response = $this->get('/docs');
        $response->assertOk();
        $response->assertSee('Readme Page');
    }

    /** @test */
    public function render_exists_page()
    {
        $this->putDocs('foo', 'Foo Page');
        $response = $this->get('/docs/foo');
        $response->assertOk();
        $response->assertSee('Foo Page');
    }

    /** @test */
    public function render_not_exists_page()
    {
        $response = $this->get('/docs/foo');
        $response->assertNotFound();
    }

    protected function putReadmeDocs()
    {
        $this->putDocs('readme', 'Readme Page');
    }

    protected function putDocs($name, $content)
    {
        file_put_contents(
            resource_path("docs/{$name}.md"),
            $content,
            FILE_APPEND
        );
    }
}
