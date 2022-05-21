Fork of wdCalendar
=================

Thanks for the great source.

The goal is to refactor the php code base and increase security level.

Milestone
========
0.1 [in progress] Create public and application folder and use index.php as only file to deal with request

0.2 [done] Implement View for dealing with layouts 

0.3 [done] Implement and use easily configuration file (table prefix, default controller, default action etc.)

0.4 [in progress] Add authentification

0.5 [in progress] Add user and group based calendar (with sharing via groups) but without fancy admin interface (this should be sql based)

0.6 Cover code with unittests (pretty late, right?)

0.7 Update setup and write install howto as well as wiki entires

0.8 Implement security stuff for handling with user input

0.9 Bugfixing

1.0 First stable release

1.x Add caching for configuration file

    Create classmap generator to enhance autoloader

    Write install script

    Implement Event Designpattern

    Replace vendor classes with Zend Framework 2 classes where needed

Original Readme (2012-02-16)
===========================

wdCalendar
==========

wdCalendar is a jquery based google calendar clone. Based on http://www.web-delicious.com/jquery-plugins-demo/wdCalendar/docs/index.htm

1. Introduction
This is wdCalendar version2 and allowed to use freely (LGPL).

2. Browsers Supported
FireFox2.0+ IE6+ Opera9+ Safari3+ Chrome

3. Installation & Usage
Download the package and unzip to a directory.
Copy unzipped directory to apache www directory/sub-directory.
Open sample.php in your browser.
-----------------------IMPORTANT!!!IMPORTANT!!!-----------------
By default, events are created randomly. If you would like it work with database, please
a. create a database, and execute setup.sql
b. change php/dbconfig.php to fit yours
c. rename edit.db.php to edit.php, php/datafeed.db.php to php/datafeed.php (you may backup edit.php/datafeed.php)

4. About web-delicious.com
We are an IT outsourcing company location in Shanghai, China.
We provide end-to-end solutions in web development (Web 2.0, PHP, ASP.NET, ASP, JSP, XML, Flash),
application development and IT consulting services at very reasonable price.
www.web-delicious.com


5.Credits
jQuery is a new kind of JavaScript Library. http://jquery.com/
wdCalendar Library. base script from http://www.web-delicious.com

