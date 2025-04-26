# Media Library

* server api part for the media library

# Old - for history reasons

This project wants to provide a rest based application to manage your media library. With version 1, it will have support for audio, book, game and video.

It is written in javascript, html and php. The frontend will be an ajax based single side page. A possible mobile app is planned but in the far far away future.

# Milestones

* 0.0.1 -   basic directory structure and database is done, "hello world" from frontend to backend is working
* 0.0.2 -   rest api draft
* 0.1.0 -   user login and session management is working
* 0.2.0 -   basic design with prepared demo data is working
* 0.3.0 -   insert/edit/delete (CRUD) do deal with real data
* 0.4.0 -   implement cqrs
* 0.7.0 -   script to setup empty project
* 0.8.0 -   script to update system (backup data, composer update)
* 0.9.0 -   user based media library is working (no sharing between users)
* 1.0.0 -   first release, like 0.9.0 but with all tests, documentation and stablie api

# Notes

* authentication
    * login/password - only hashes are stored in the database

# Future Plans

* implement search
* implement elastic search or other nosql based search
* implement unix right based system to share libaries (user, group, other/public)
* extend search to search for shared libraries
* implement wish list
* implement borrwed list
* create mobile phone application
* fetch more informations by using third party sources like wikipedia or amazon
* implement plugin and update architecture
* divide read from write logic (as demonstrated in php magazin 5.14 p 10 ff, CQRS)
    * use php/propel objects for writing (by supporting Commands)
        * writing is working with events to keep update in sql database fast
        * event handler is taking care of updating reading part
    * use redis/coucheDb for reading (by supporting queries)
        * data of reading can differ from needed output
            * simple json/xml for general questions
            * full json/xml when manipulating data

# Thanks

* [khepin - Example Project (quick start for silex)](https://github.com/khepin/tsusbos/)
* [Matthias Noback - Setting Up Project Structure For Silex](http://php-and-symfony.matthiasnoback.nl/2012/01/silex-getting-your-project-structure-right/)
* [Sensiolabs - Silex](http://silex.sensiolabs.org/)
* [Silcone Skeleton - Silex Bootstrap Application](https://github.com/elfet/silicone-skeleton)
* [Silex Kitchen Edition - Silex Bootstrap Application](https://github.com/lyrixx/Silex-Kitchen-Edition/tree/master/src)
* [Silex Examples](https://github.com/igorw/silex-examples)
* [Silex Rest Example](https://github.com/vesparny/silex-simple-rest)
* [Silex Propel Service Provider](https://github.com/propelorm/PropelServiceProvider)
* [Silex User Handling Example](https://github.com/jmpantoja/silexhttps://github.com/silexphp/Silex-Skeleton-user)
* [Silex Skeleton](https://github.com/mablo/Silex-skeletion)
* [Scaling Silex Applications](http://gonzalo123.com/2013/02/11/scaling-silex-applications/)
* [Silex Skeleton](https://github.com/silexphp/Silex-Skeleton)
* [Microframework Silex](http://www.scandio.de/2012/01/microframework-silex/)
* [Silex Anatomy By Igor Wiedler](http://formations.only-cash.net/web/video/9VUoIruQNMg/Silex-Anatomy-by-Igor-Wiedler-at-the-PHP-Benelux-Conference-2013.html)
