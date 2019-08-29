<?php

namespace Serverdog\Laratests\Services;

use ReflectionClass;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Output\BufferedOutput;

class TestGeneratorService
{
    const SUPPORTED_VERSION = '5.8.26';
    private $modelPath;
    private $modelFactoryList;

    public function __construct()
    {
        $this->modelPath = config('laratests.modelPath');
        $this->generate();
    }

    private function generate()
    {
        if ($this->canUseJsonRoutes()) {
            $rawRoutes = $this->getJsonRoutes();
        } else {
            abort(403, "Sorry, we'll add support for this version later. Please upgrade to ". self::SUPPORTED_VERSION);
        }
        $routes = [];

        $namespace = $this->modelPath;

        foreach ($rawRoutes as $route) {
            $name = $route->name ?? $route->uri;
            $explodedName = explode('.', $route->name);
            $route->type = last($explodedName);
            $route->method = strtolower(explode("|", $route->method)[0]);
            $route->class=null;
            if (count($explodedName) > 1) {
                $route->class = ucfirst(str_singular($explodedName[count($explodedName)-2]));
                $route->classExists = class_exists($this->modelPath.$route->class);
            }
            $route->factoryExists = $this->hasFactory($route->class);
                
            array_set($routes, $name, $route);
        };


        foreach ($routes as $className => $endpoints) {
            if (is_array($endpoints)) {
                echo View::make('laratests::resource')->with(compact('className', 'endpoints', 'namespace'))->render();
            } elseif ($endpoints->action == "Closure") {
                $route=$endpoints;
                
                echo View::make('laratests::closure')->with(compact('route'))->render();
            }
            echo "\r\n";
        }
    }

    private function getJsonRoutes()
    {
        $output = new BufferedOutput;

        Artisan::call('route:list  --json', array(), $output);
    
        return json_decode($output->fetch());
    }


    /**
     * canUseJsonRoutes
     *
     * Checks if we can use the JSON routes
     *
     * @return boolean
     */
    private function canUseJsonRoutes() :bool
    {
        $version = App::VERSION();
        return version_compare($version, self::SUPPORTED_VERSION, ">=");
    }

    private function createResourceTest()
    {
        echo View::make('laratests::class')->with(compact('className', 'endpoints', 'namespace'))->render();
    }

    private function hasFactory($class)
    {
        if (is_null($this->modelFactoryList)) {
            $this->setModelFactoryList($class);
        }
        return in_array($this->modelPath.$class, $this->modelFactoryList);
    }

    private function setModelFactoryList($class)
    {
        $factory = factory($this->modelPath.$class);
        $reflection = new ReflectionClass($factory);
        $property = $reflection->getProperty('definitions');
        $property->setAccessible(true);
        $this->modelFactoryList =  array_keys($property->getValue($factory));
    }
}
