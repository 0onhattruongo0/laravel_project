<?php

namespace Modules;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\ServiceProvider;
use Modules\User\src\Repositories\UserRepository;
use Modules\Group\src\Repositories\GroupRepository;
use Modules\Order\src\Repositories\OrderRepository;
use Modules\Video\src\Repositories\VideoRepository;
use Modules\Lesson\src\Repositories\LessonRepository;
use Modules\Module\src\Repositories\ModuleRepository;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Student\src\Repositories\StudentRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Document\src\Repositories\DocumentRepository;
use Modules\Home\src\Http\Middlewares\homeLoginMiddleware;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Group\src\Repositories\GroupRepositoryInterface;
use Modules\Order\src\Repositories\OrderRepositoryInterface;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Lesson\src\Repositories\LessonRepositoryInterface;
use Modules\Module\src\Repositories\ModuleRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Student\src\Repositories\StudentRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;


class ModuleServiceProvider extends ServiceProvider
{

    private $middleware = [
        'homeLogin' => homeLoginMiddleware::class
    ];

    private $commands = [];

    public function registerRepositories()
    {
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->singleton(
            TeacherRepositoryInterface::class,
            TeacherRepository::class
        );

        $this->app->singleton(
            CoursesRepositoryInterface::class,
            CoursesRepository::class
        );

        $this->app->singleton(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class
        );
        $this->app->singleton(
            VideoRepositoryInterface::class,
            VideoRepository::class
        );
        $this->app->singleton(
            DocumentRepositoryInterface::class,
            DocumentRepository::class
        );
        $this->app->singleton(
            LessonRepositoryInterface::class,
            LessonRepository::class
        );
        $this->app->singleton(
            GroupRepositoryInterface::class,
            GroupRepository::class
        );
        $this->app->singleton(
            ModuleRepositoryInterface::class,
            ModuleRepository::class
        );
        $this->app->singleton(
            StudentRepositoryInterface::class,
            StudentRepository::class
        );
        $this->app->singleton(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );
    }

    public function boot()
    {
        $directories = $this->getModules();
        if (!empty($directories)) {
            foreach ($directories as $moduleName) {
                $this->registerModule($moduleName);
            }
        }
    }

    public function register()
    {
        // // Khai báo configs
        $directories = $this->getModules();
        // dd(File::directories(__DIR__));
        if (!empty($directories)) {
            foreach ($directories as $directory) {
                $configPath = __DIR__ . '/' . $directory . '/configs';
                // dd($configPath);
                if (File::exists($configPath)) {
                    $configFiles = array_map('basename', File::allFiles($configPath));
                    // dd($configFiles);
                    foreach ($configFiles as $config) {
                        $alias = basename($config, '.php');
                        // dd($alias);
                        // dd($configPath.'/'.$config);
                        $this->mergeConfigFrom($configPath . '/' . $config, $alias);
                    }
                }
            }
        }

        // // Khai báo configs
        // $configFile = [
        // 'configs' => __DIR__.'/User/configs/config.php',
        // ];
        // foreach ($configFile as $alias => $path) {
        // $this->mergeConfigFrom($path, $alias);
        // }


        $this->registerMiddleware($this->middleware);

        // Khai báo commands
        $this->commands($this->commands);

        $this->registerRepositories();

        // $this->app->singleton(
        //     UserRepositoryInterface::class,
        //     UserRepository::class
        // );
    }

    // Khai báo đăng ký cho từng modules
    private function registerModule($moduleName)
    {
        $modulePath = __DIR__ . "/$moduleName/";
        // Khai báo thành phần ở đây

        // Khai báo route

        Route::middleware('web')->group(function () use ($modulePath) {
            if (File::exists($modulePath . "routes/web.php")) {
                $this->loadRoutesFrom($modulePath . "routes/web.php");
            }
        });



        // Khai báo migration
        // Toàn bộ file migration của modules sẽ tự động được load
        if (File::exists($modulePath . "migrations")) {
            $this->loadMigrationsFrom($modulePath . "migrations");
        }

        // Khai báo languages
        if (File::exists($modulePath . "resources/lang")) {
            // Đa ngôn ngữ theo file php
            // Dùng đa ngôn ngữ tại file php resources/lang/en/general.php : @lang('Demo::general.hello')
            $this->loadTranslationsFrom($modulePath . "resources/lang", strtolower($moduleName));
            // Đa ngôn ngữ theo file json
            $this->loadJSONTranslationsFrom($modulePath . 'resources/lang');
        }

        // Khai báo views
        // Gọi view thì ta sử dụng: view('Demo::index'), @extends('Demo::index'), @include('Demo::index')
        if (File::exists($modulePath . "resources/views")) {
            $this->loadViewsFrom($modulePath . "resources/views", strtolower($moduleName));
        }

        // Khai báo helpers
        if (File::exists($modulePath . "helpers")) {
            // Tất cả files có tại thư mục helpers
            $helper_dir = File::allFiles($modulePath . "helpers");
            // khai báo helpers
            foreach ($helper_dir as $key => $value) {
                $file = $value->getPathName();
                // echo $file;
                require $file;
            }
        }
    }

    private function getModules()
    {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }

    private function registerMiddleware($middleware)
    {
        foreach ($middleware as $key => $value) {
            $this->app['router']->pushMiddlewareToGroup($key, $value);
        }
    }
}
