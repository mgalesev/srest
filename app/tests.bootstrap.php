<?php

if (isset($_ENV['BOOTSTRAP_ENV'])) {

    // clear cache
    passthru(sprintf(
        'php "%s/console" cache:clear --env=%s --no-warmup --quiet',
        'bin',
        $_ENV['BOOTSTRAP_ENV']
    ));

    // drop database
    passthru(sprintf(
        'php "%s/console" doctrine:database:drop --force --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_ENV']
    ));

    // create database
    passthru(sprintf(
        'php "%s/console" doctrine:database:create --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_ENV']
    ));

    // load migrations
    passthru(sprintf(
        'php "%s/console" doctrine:migrations:migrate --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_ENV']
    ));

    // load text fixures
    passthru(sprintf(
        'php "%s/console" h:d:f:l --env=%s --quiet',
        'bin',
        $_ENV['BOOTSTRAP_ENV']
    ));
}

require __DIR__.'/autoload.php';