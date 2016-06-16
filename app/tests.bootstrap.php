<?php

if (isset($_ENV['BOOTSTRAP_CLEAR_CACHE_ENV'])) {

    // clear cache
    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s --no-warmup --quiet',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    // drop database
    passthru(sprintf(
        'php "%s/console" doctrine:database:drop --force --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    // create database
    passthru(sprintf(
        'php "%s/console" doctrine:database:create --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    // create schema
    passthru(sprintf(
        'php "%s/console" doctrine:schema:create --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));

    // load text fixures
    passthru(sprintf(
        'php "%s/console" h:d:f:l --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_CLEAR_CACHE_ENV']
    ));
}

require __DIR__.'/autoload.php';