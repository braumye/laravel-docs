<?php

namespace Braumye\LaravelDocs\Tests;

use Braumye\LaravelDocs\LaravelDocsServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    /**
     * Get the service providers for the package.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            LaravelDocsServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->app['config']->set('app.key', 'base64:UTyp33UhGolgzCK5CJmT+hNHcA+dJyp3+oINtX+VoPI=');

        if (! is_dir($dir = resource_path('docs'))) {
            mkdir($dir);
        }
    }

    protected function tearDown(): void
    {
        if (is_dir($dir = resource_path('docs'))) {
            $this->rmdirRecursive($dir);
        }

        parent::tearDown();
    }

    protected function rmdirRecursive($dir)
    {
        foreach (scandir($dir) as $file) {
            if ('.' === $file || '..' === $file) {
                continue;
            }
            if (is_dir("$dir/$file")) {
                $this->rmdirRecursive("$dir/$file");
            } else {
                unlink("$dir/$file");
            }
        }
        rmdir($dir);
    }
}
