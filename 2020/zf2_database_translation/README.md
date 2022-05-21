# Database Based Translation For Zend Framework 2

* based on [my thougts](https://artodeto.bazzline.net/archives/814-zend-framework-2-translation-on-steroids-some-thoughts.html)
* replace existing translation view helper with an databased one
* add a sql script to setup the database
* add a command line to copy the existing translations into the database
* add an administration form to update the translations
* add configuration section to use redis as caching

# delivery mechanism

## console

* dump database <local> <path_to_dumped.pot> [--force]
* initialize database <locale> <path_to.pot> [--verbose]
* update database <locale> <path_to.pot> [--soft-delete]

## web 

* update database message

# database

## tables

```sql
CREATE DATABASE `translation` 
DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

USE DATABASE `translation`;

CREATE TABLE IF NOT EXISTS `locale` (
    `id` int(11) NOT NULL,
    `locale` varchar(5) NOT NULL,
    `plural_rule_as_string` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- @todo add primary key, foreign key constraint and index

CREATE TABLE IF NOT EXISTS `message_keys` (
    `id` int(11) NOT NULL,
    `key` longtext,
    `domain` varchar(255) binary NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `message_values` (
    `id` int(11) NOT NULL,
    `locale_id` int(11) DEFAULT NULL,
    `key_id` int(11) DEFAULT NULL,
    `value` longtext NOT NULL,
    `plural_index` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
```

# useful code

* [official page](http://framework.zend.com/manual/current/en/user-guide/styling-and-translations.html)
* [official page on github](https://github.com/zendframework/zend-i18n)
* [official translation page](http://framework.zend.com/manual/current/en/modules/zend.i18n.translating.html)
* [learn translation](http://learnzf2.sitrun-tech.com/learn-zf2-i18n)
* [translation loader for doctrine](https://github.com/bushbaby/BsbDoctrineTranslationLoader)
* [po on wikipedia](https://en.wikipedia.org/wiki/Portable_object_(computing))
* [gettext on wikipedia](https://en.wikipedia.org/wiki/Gettext)
* [official gettext page](https://www.gnu.org/software/gettext/gettext.html)
* [official manpage of gettext](https://www.gnu.org/software/gettext/manual/gettext.html)
* [zend framework 2 skeleton application](https://github.com/zendframework/ZendSkeletonApplication)

# gettext

* analyze source code to create \*.pot file
    #: src/my_file.php:36
    msgid "foo\n"
    msgstr ""
* based on the \*.pot file, create a \*_your_language.po file
    #: src/my_file.php:36
    msgid "foo\n"
    msgstr "translation of foo is not possible"
* based on the \*_your_language.po file, create a \*_your_language.mo file

# questions

* use `RemoteLoaderInterface`?
    * for database
* provide CacheAdapter
    * for cache
* create generic repository and create a zf2 module with glue code only?
* simple use [BsbDoctrineTranslationLoader](https://github.com/bushbaby/BsbDoctrineTranslationLoader/blob/master/composer.json)
* how to support [plural translation](http://framework.zend.com/manual/current/en/modules/zend.i18n.translating.html#translating-messages)
