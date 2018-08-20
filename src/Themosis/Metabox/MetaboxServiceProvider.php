<?php

namespace Themosis\Metabox;

use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\ArraySerializer;
use Themosis\Metabox\Resources\MetaboxResource;
use Themosis\Metabox\Resources\Transformers\MetaboxTransformer;

class MetaboxServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('metabox', function ($app) {
            $resource = new MetaboxResource(
                $app->bound('league.fractal') ? $app['league.fractal'] : new Manager(),
                new ArraySerializer(),
                new MetaboxTransformer()
            );

            return new Factory($app, $app['action'], $resource);
        });
    }
}
