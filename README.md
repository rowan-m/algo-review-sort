"Algorithm, Review, Sort"
=========================

Sample code and presentation from PHP Benelux 2013

Installation
------------

This assumes you already have [Composer](http://getcomposer.org/ "Composer - Dependency Manager for PHP ") installed.

    git clone git@github.com:rowan-m/algo-review-sort.git
    cd algo-review-sort
    composer.phar install

Running
-------

The presentation is a Silex application using [reveal.js](http://lab.hakim.se/reveal-js), so you'll need to  fire up a webserver. The built in one will work just fine.

    php -S localhost:8000 -t web/

You can then browse to [http://localhost:8000/presentation](http://localhost:8000/presentation)

The individual visualisations are also available:
* [http://localhost:8000/sort/insertion](http://localhost:8000/sort/insertion)
* [http://localhost:8000/sort/bubble](http://localhost:8000/sort/bubble)
* [http://localhost:8000/sort/quick](http://localhost:8000/sort/quick)
* [http://localhost:8000/sort/heap](http://localhost:8000/sort/heap)

You can pass `total` in the query string to change the number of elements, e.g. [http://localhost:8000/sort/quick?total=10](http://localhost:8000/sort/quick?total=10)

Exported Presentation
---------------------

There's also a [PDF export of the presentation](/rowan-m/algo-review-sort/raw/master/algo-review-sort.pdf) in case you don't feel like running the code. It's not as pretty though.
