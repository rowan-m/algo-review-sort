"Algorithm, Review, Sort"
=========================

Sample code and presentation from SunshinePHP 2014. If you watched the talk, please [leave me some feedback](https://joind.in/10507)!

The code is running over on AppEngine at [algo-review-sort.appspot.com](http://algo-review-sort.appspot.com).

There's also a [PDF export of the presentation](https://github.com/rowan-m/algo-review-sort/raw/master/algo-review-sort.pdf) from earlier conferences in case you don't feel like running the code (you should though, it's more fun).

You can also view the export on [Speaker Deck](https://speakerdeck.com/rowan_m/algorithms-sorting-and-searching)

Installation
------------

This assumes you already have [Composer](http://getcomposer.org/ "Composer - Dependency Manager for PHP ") installed.

    git clone git@github.com:rowan-m/algo-review-sort.git
    cd algo-review-sort
    composer.phar install

Running
-------

The presentation is a Silex application using [reveal.js](http://lab.hakim.se/reveal-js), so you'll need to  fire up a webserver. The built in one will work just fine.

    php -S localhost:8080 -t .

You can then browse to [http://localhost:8080/](http://localhost:8080/)

The individual visualisations are also available:
* [http://localhost:8080/sort/insertion](http://localhost:8080/sort/insertion)
* [http://localhost:8080/sort/bubble](http://localhost:8080/sort/bubble)
* [http://localhost:8080/sort/quick](http://localhost:8080/sort/quick)
* [http://localhost:8080/sort/heap](http://localhost:8080/sort/heap)
* [http://localhost:8080/search/sequential](http://localhost:8080/search/sequential)
* [http://localhost:8080/search/binary](http://localhost:8080/search/binary)

You can pass `total` in the query string to change the number of elements, e.g. [http://localhost:8080/sort/quick?total=10](http://localhost:8080/sort/quick?total=10)
