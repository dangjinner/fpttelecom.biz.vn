<?php

namespace Webmaster\ThemeCreator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class ThemeGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:make {name : The name of the theme}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $themeName = $this->argument('name');

        // Gọi các Artisan command liên quan
        $commands = [
            'theme:make-controller',
            'theme:make-provider',
            'theme:make-adcontroller',
            'theme:make-request',
            'theme:make-vcomposer',
            'theme:make-adtabs',
            'theme:make-config',
            'theme:make-sidebar',
            'theme:make-banner',
            'theme:make-json',
            'theme:make-webpack',
            'theme:make-routeadmin',
            'theme:make-routepublic',
            'theme:make-js',
            'theme:make-css',
            'theme:make-lang',
            'theme:make-vadmin',
            'theme:make-verror',
            'theme:make-vlayout',
            'theme:make-vhome',
        ];

        try {
            foreach ($commands as $command) {
                Artisan::call("$command $themeName");
            }
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
        }


        $this->info("Theme '{$themeName}' was created successfully!");
    }
}
