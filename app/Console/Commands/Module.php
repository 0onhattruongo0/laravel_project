<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class Module extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:module {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create module CLI';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');

        if(File::exists(base_path('modules/'.$name))){
            $this->error('Module already exists!');
        }else{
            File::makeDirectory(base_path('modules/'.$name), 0755, true, true);
            
            // config
            $configFolder = base_path('modules/'.$name.'/configs');

            if(!File::exists($configFolder)){
                File::makeDirectory($configFolder, 0755, true, true);
            }

            // helper
            $helperFolder = base_path('modules/'.$name.'/helpers');

            if(!File::exists($helperFolder)){
                File::makeDirectory($helperFolder, 0755, true, true);
            }

            // migration
            $migrationFolder = base_path('modules/'.$name.'/migrations');

            if(!File::exists($migrationFolder)){
                File::makeDirectory($migrationFolder, 0755, true, true);
            }

            // resources
            $resourcesFolder = base_path('modules/'.$name.'/resources');

            if(!File::exists($resourcesFolder)){
                File::makeDirectory($resourcesFolder, 0755, true, true);

                // lang
                $langFolder = base_path('modules/'.$name.'/resources/lang');

                if(!File::exists($langFolder)){
                    File::makeDirectory($langFolder, 0755, true, true);
                }

                // view
                $viewFolder = base_path('modules/'.$name.'/resources/views');

                if(!File::exists($viewFolder)){
                    File::makeDirectory($viewFolder, 0755, true, true);
                }
            }

            // routes
            $routesFolder = base_path('modules/'.$name.'/routes');

            if(!File::exists($routesFolder)){
                File::makeDirectory($routesFolder, 0755, true, true);

                // web.php
                $routesFile = base_path('modules/'.$name.'/routes/web.php');

                if(!File::exists($routesFile)){
                    File::put($routesFile,"<?php \n use Illuminate\Support\Facades\Route;");
                }
            }

            // src
            $srcFolder = base_path('modules/'.$name.'/src');

            if(!File::exists($srcFolder)){
                File::makeDirectory($srcFolder, 0755, true, true);

                // command
                $commandFolder = base_path('modules/'.$name.'/src/Command');

                if(!File::exists($commandFolder)){
                    File::makeDirectory($commandFolder, 0755, true, true);
                }

                // Http
                $httpFolder = base_path('modules/'.$name.'/src/Http');

                if(!File::exists($httpFolder)){
                    File::makeDirectory($httpFolder, 0755, true, true);

                    // controller
                    $controllerFolder = base_path('modules/'.$name.'/src/Http/Controllers');

                    if(!File::exists($controllerFolder)){
                        File::makeDirectory($controllerFolder, 0755, true, true);
                    }

                     // middleware
                     $middlewareFolder = base_path('modules/'.$name.'/src/Http/Middlewares');

                     if(!File::exists($middlewareFolder)){
                         File::makeDirectory($middlewareFolder, 0755, true, true);
                     }

                }

                // model
                $modelFolder = base_path('modules/'.$name.'/src/Model');

                if(!File::exists($modelFolder)){
                    File::makeDirectory($modelFolder, 0755, true, true);
                }

                // repositories
                $repositoryFolder = base_path('modules/'.$name.'/src/Repositories');

                if(!File::exists($repositoryFolder)){
                    File::makeDirectory($repositoryFolder, 0755, true, true);

                    //ModuleRepository
                    $moduleRepositoryFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'Repository.php');

                    if(!File::exists($moduleRepositoryFile)){
                        $moduleRepositoryFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepository.txt'));
                        $moduleRepositoryFileContent = str_replace('{module}',$name,$moduleRepositoryFileContent);
                        File::put($moduleRepositoryFile,$moduleRepositoryFileContent);
                    }

                    //ModuleRepositoryInterface
                    $moduleRepositoryInterfaceFile = base_path('modules/'.$name.'/src/Repositories/'.$name.'RepositoryInterface.php');

                    if(!File::exists($moduleRepositoryInterfaceFile)){
                        $moduleRepositoryInterfaceFileContent = file_get_contents(app_path('Console/Commands/Templates/ModuleRepositoryInterface.txt'));
                        $moduleRepositoryInterfaceFileContent = str_replace('{module}',$name,$moduleRepositoryInterfaceFileContent);
                        File::put($moduleRepositoryInterfaceFile,$moduleRepositoryInterfaceFileContent);
                    }
                    
                }

            }
            
            
            $this->info('Module created successfully!');
        }
    }
}
