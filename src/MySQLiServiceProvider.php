<?php

namespace LaravelEloquentMySQLi;

use Illuminate\Database\Connection;
use Illuminate\Support\ServiceProvider;

class MySQLiServiceProvider extends ServiceProvider
{
    /**
     * Boot the services for the application.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerMySQLiConnector();
    }

    /**
     * Register the mysqli connector driver for eloquent
     *
     * @return void
     */
    protected function registerMySQLiConnector()
    {
        $app = $this->app;

        Connection::resolverFor('mysqli', function ($connection, $database, $prefix, $config) use ($app) {
            return new MySQLiConnection(
                $connection(), $database, $prefix, $config
            );
        });

        $this->app->bind('db.connector.mysqli', function ($app) {
            return new MySQLiConnector();
        });

        $this->app['db']->extend('mysqli', function (array $config, $name) use ($app) {
            $adapter = $app['db.connector.mysqli']->connect($config);
            return new MySQLiConnection($adapter, $config['database'], $config['prefix'], $config);
        });
    }
}
