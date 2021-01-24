<?php

namespace Braumye\LaravelDocs\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install all of the Laravel Docs resources';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->comment('Publishing Laravel Docs Assets...');
        $this->callSilent('vendor:publish', ['--tag' => 'docs-assets']);

        $this->comment('Publishing Laravel Docs Configuration...');
        $this->callSilent('vendor:publish', ['--tag' => 'docs-config']);

        $this->info('Laravel Docs scaffolding installed successfully.');
    }
}
