<?php

namespace Braumye\LaravelDocs\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish all of the Laravel Docs resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->call('vendor:publish', [
            '--tag' => 'docs-assets',
            '--force' => true,
        ]);
    }
}
