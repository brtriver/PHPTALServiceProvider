# PHPTALServiceProvider, a part of Silex Framework Providers

[PHPTAL][1] is one of PHP template engines, which is an implementation of the excellent Zope Page Template (ZPT) system for PHP.
And [Silex][2] is a PHP microframework, which is very light and is based on [Symfony2][3].
This extension allow you to use PHPTAL as a template engine in Silex.

## Instllation

the best way to install this service provider is to use composer. as the first, creating `composer.json` file in your project below:

        {
            "require": {
                "brtriver/PHPTALServiceProvider": "dev-master"
            }
        }

If you also want to install PHPTAL, just added like below:

        {
            "repositories": [
                {
                    "type": "package",
                    "package": {
                        "name": "pornel/PHPTAL",
                        "version": "1.2.2",
                        "dist": {
                            "url": "http://phptal.org/files/PHPTAL-1.2.2.zip",
                            "type": "zip"
                        },
                        "source": {
                            "url": "https://github.com/pornel/PHPTAL.git",
                            "type": "git",
                            "reference": "Release 1.2.2"
                        }
                    }
                }
            ],
            "require": {
                "brtriver/PHPTALServiceProvider": "dev-master",
                "pornel/PHPTAL": "1.2.2"
            }
        }

then install composer.php and install

    $ wget http://getcomposer.org/composer.phar
    $ php composer.phar install

download PHPTALServiceProvider and set to this directory and finally the path of this is below:
./vendor/brtriver/PHPTALServiceProvider/PHPTALServiceProvider.php

Then PHPTAL library is set to ./vendor/phptal directory and PHPTAL templates is set under views directory.

    /project_directory
    │  ├── .htaccess
    │  ├── silex.phar
    │  ├── composer.json
    │  ├── composer.phar
    │  └── index.php
    ├── vendor
    │   ├── bin
    │   ├── brtriver
    │   │   └── PHPTALServiceProvider
    │   │       └─ PHPTALServiceProvider.php
    │   └── pornel
    │       └── PHPTAL
    └── views
        └── teset.html (PHPTAL template files is set here)

## Sample Code

in index.php, you require this PHPTALServiceProvider file and register it, then your code is like below:

### index.php
After calling register method, $app['phptal'] is a instance of PHPTAL. You can use it as PHPTAL itself.
You have to set a template path first.

    <?php
    require_once __DIR__.'/silex.phar';
    require_once __DIR__.'/vendor/brtriver/PHPTALServiceProvider/PHPTALServiceProvider.php';

    use Silex\Provider\PHPTALServiceProvider;

    $app = new Silex\Application();
    $app['phptal.class_path'] = __DIR__.'/vendor/pornel/PHPTAL';
    $app->register(new PHPTALServiceProvider());

    $app->get('/hello/{name}', function($name) use($app) {
        // set your view file. view file is set under /views directory
        $app['phptal.view'] = "test.html";
        $app['phptal']->title = "PHPTAL in Silex";
        $app['phptal']->name = $name;
        return $app['phptal']->execute();
    });

    $app->run();

### test.html

    <?xml version="1.0"?>
    <html>
      <head>
        <title tal:content="title">
          Place for the page title
        </title>
      </head>  <body>
        <h1 tal:content="title">sample title</h1>
        <table>
          <thead>
            <tr>
              <th>Name</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td tal:content="name">person's name</td>
              </tr>
              <tr tal:replace="">
                <td>sample name</td>
              </tr>
          </tbody>
        </table>
      </body>
    </html>

## License

PHPTALExtension is licensed under the MIT license.

[1]: http://phptal.org/manual/en/split/introduction.html
[2]: http://silex.sensiolabs.org/
[3]: http://symfony.com