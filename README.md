# php-image

Simplify the image processing in PHP (by [Petr Knap])


## Image class

Class [`Image`] provides methods for loading, transforming, storing and displaying image data.
The code is being developed since 2008.
If you need to add method for specific functionality, please send your proposal or modified source code to [Issues].


## How to install

Run `composer require petrknap/php-image` or merge this JSON code with your project `composer.json` file manually and run `composer install`.
Instead of `dev-master` you can use [one of released versions].

```json
{
    "require": {
        "petrknap/php-image": "dev-master"
    }
}
```

Or manually clone this repository via `git clone https://github.com/petrknap/php-profiler.git` or download [this repository as ZIP] and extract files into your project.

### Versioning

Version is sequence of 3 numbers separated by dot (for example `1.2.3`).
First number is increased by changes in old methods (f.e.: added parameter, throws new exception, etc.).
Second number is increased by new features (f.e.: added property, constant, method, etc.).
Third number is simple indicator of insignificant change (f.e.: code improvements).


[Petr Knap]:http://petrknap.cz/
[`Image`]:https://github.com/petrknap/php-image/blob/master/src/Image/Image.php
[Issues]:https://github.com/petrknap/php-image/issues
[one of released versions]:https://github.com/petrknap/php-image/releases
[this repository as ZIP]:https://github.com/petrknap/php-image/archive/master.zip
