<?php

namespace Braumye\LaravelDocs;

use Illuminate\Contracts\Cache\Repository as Cache;
use Illuminate\Filesystem\Filesystem;
use Parsedown;

class Documentation
{
    /**
     * The filesystem implementation.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The cache implementation.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * Create a new documentation instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  \Illuminate\Contracts\Cache\Repository  $cache
     * @return void
     */
    public function __construct(Filesystem $files, Cache $cache)
    {
        $this->files = $files;
        $this->cache = $cache;
    }

    /**
     * Get the documentation index page.
     *
     * @return string|null
     */
    public function getIndex()
    {
        return $this->cache->remember('docs.index', 5, function () {
            $path = base_path('resources/docs/documentation.md');

            if ($this->files->exists($path)) {
                return (new Parsedown())->text($this->files->get($path));
            }

            return null;
        });
    }

    /**
     * Get the given documentation page.
     *
     * @param  string  $page
     * @return string|null
     */
    public function get($page)
    {
        return $this->cache->remember('docs.'.$page, 5, function () use ($page) {
            $path = base_path('resources/docs/'.$page.'.md');

            if ($this->files->exists($path)) {
                return (new Parsedown)->text($this->files->get($path));
            }

            return null;
        });
    }

    /**
     * Check if the given section exists.
     *
     * @param  string  $page
     * @return boolean
     */
    public function sectionExists($page)
    {
        return $this->files->exists(
            base_path('resources/docs/'.$page.'.md')
        );
    }

    /**
     * Determine which versions a page exists in.
     *
     * @param  string  $page
     * @return \Illuminate\Support\Collection
     */
    public function versionsContainingPage($page)
    {
        return collect([]);
    }
}
