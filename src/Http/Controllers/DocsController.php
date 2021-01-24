<?php

namespace Braumye\LaravelDocs\Http\Controllers;

use Braumye\LaravelDocs\Documentation;
use Symfony\Component\DomCrawler\Crawler;

class DocsController extends Controller
{
    /**
     * The documentation repository.
     *
     * @var \Braumye\LaravelDocs\Documentation
     */
    protected $docs;

    /**
     * Create a new controller instance.
     *
     * @param  \Braumye\LaravelDocs\Documentation  $docs
     * @return void
     */
    public function __construct(Documentation $docs)
    {
        $this->docs = $docs;
    }

    /**
     * Show a documentation page.
     *
     * @param  string|null  $page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show($page = null)
    {
        $sectionPage = $page ?: 'readme';
        $content = $this->docs->get($sectionPage);

        if (is_null($content)) {
            $otherVersions = $this->docs->versionsContainingPage($page);

            return response()->view('docs::docs', [
                'title' => 'Page not found',
                'index' => $this->docs->getIndex(),
                'content' => view('docs::docs-missing', [
                    'otherVersions' => $otherVersions,
                    'page' => $page,
                ]),
                'currentVersion' => 'master',
                'versions' => [],
                'currentSection' => '',
                'canonical' => null,
            ], 404);
        }

        $title = (new Crawler($content))->filterXPath('//h1');

        $section = '';

        if ($this->docs->sectionExists($page)) {
            $section .= '/'.$page;
        } elseif (! is_null($page)) {
            return redirect('/docs/');
        }

        $canonical = null;

        if ($this->docs->sectionExists($sectionPage)) {
            $canonical = 'docs/'.$sectionPage;
        }

        return view('docs::docs', [
            'title' => count($title) ? $title->text() : null,
            'index' => $this->docs->getIndex(),
            'content' => $content,
            'currentVersion' => 'master',
            'versions' => [],
            'currentSection' => $section,
            'canonical' => $canonical,
        ]);
    }
}
