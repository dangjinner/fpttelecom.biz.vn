<?php

namespace Webmaster\ThemeCreator\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ThemeGeneratorCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'theme:make {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme.';

    public function handle() {
        // $this->call('theme:make-controller abc' );    
        Artisan::call('theme:make-controller ' . $this->argument('name') );
        Artisan::call('theme:make-provider '. $this->argument('name') );
        Artisan::call('theme:make-adcontroller '. $this->argument('name') );
        Artisan::call('theme:make-request '. $this->argument('name') );
        Artisan::call('theme:make-vcomposer '. $this->argument('name') );
        Artisan::call('theme:make-adtabs '. $this->argument('name') );
        Artisan::call('theme:make-config '. $this->argument('name') );
        Artisan::call('theme:make-sidebar '. $this->argument('name') );
        Artisan::call('theme:make-banner '. $this->argument('name') );
        Artisan::call('theme:make-json '. $this->argument('name') );
        Artisan::call('theme:make-webpack '. $this->argument('name') );
        Artisan::call('theme:make-routeadmin '. $this->argument('name') );
        Artisan::call('theme:make-routepublic '. $this->argument('name') );
        Artisan::call('theme:make-js '. $this->argument('name') );
        Artisan::call('theme:make-css '. $this->argument('name') );
        Artisan::call('theme:make-lang '. $this->argument('name') );
        Artisan::call('theme:make-vadmin '. $this->argument('name') );
        Artisan::call('theme:make-verror '. $this->argument('name') );
        Artisan::call('theme:make-vlayout '. $this->argument('name') );
        Artisan::call('theme:make-vhome '. $this->argument('name') );

        $this->info('Theme ' . $this->argument('name') . ' was created successfull!');
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name '],
        ];
    }



}