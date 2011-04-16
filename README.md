# PHPTALExtension, a part of Silex Framework Extension

[PHPTAL][1] is one of PHP template engines, which is an implementation of the excellent Zope Page Template (ZPT) system for PHP.
And [Silex][2] is a PHP microframework, which is very light and is based on [Symfony2][3].
This extension allow you to use PHPTAL as a template engine in Silex.

## Instllation

make directries below:
$ mkdir -p ./src/Silex/Extension/

download PHPTALExtension and set to this directory and finally the path of this extension is below:
./src/Silex/Extension/PHPTALExtension.php

Then PHPTAL library is set to ./vendor/phptal directory and PHPTAL templates is set under views directory.

    /project_directory
    │  ├── .htaccess
    │  ├── silex.phar
    │  └── index.php
    ├── src
    │   └── Silex
    │       └── Extension
    │           └── PHPTALExtension.php
    ├── vendor
    └── views
        └── teset.html (PHPTAL template files is set here)

## Sample Code

in index.php, you require this PHPTALExtension file and register it, then your code is like below:

### index.php
After calling register method, $app['phptal'] is a instance of PHPTAL. You can use it as PHPTAL itself.
You have to set a template path first.

    <?php
    require_once __DIR__.'/silex.phar';
    require_once __DIR__.'/src/Silex/Extension/PHPTALExtension.php';

    use Silex\Extension\PHPTALExtension;

    $app = new Silex\Application();
    $app->register(new PHPTALExtension());

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
[2]: http://silex-project.org/
[3]: http://symfony.com