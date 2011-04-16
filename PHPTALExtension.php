<?php

/*
 * This file is part of the Silex framework.
 *
 * (c) Masao Maeda <brt.river@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Silex\Extension;

use Silex\Application;
use Silex\ExtensionInterface;

class PHPTALExtension implements ExtensionInterface
{
    public function register(Application $app)
    {
        $app['phptal.options'] = array_replace(array(
            'path'       => __DIR__.'/../../../views/',
        ), isset($app['phptal.options']) ? $app['phptal.options'] : array());
        $app['phptal'] = $app->share(function () use ($app) {
            $phptal = new \PHPTAL($app['phptal.options']['path']. ((isset($app['phptal.view']))? $app['phptal.view']: "index.html"));
            return $phptal;
        });
        if (isset($app['phptal.class_path'])) {
            $app['autoloader']->registerPrefix('PHPTAL', $app['phptal.class_path']);
        } else {
            $app['autoloader']->registerPrefix('PHPTAL', __DIR__.'/../../../vendor/phptal');
        }
    }
}
