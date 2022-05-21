# API Token Authentication for ZF 2

# Idea

## Context

* provide abstract layer to verify if an authentication is valid

## Domain

* Application\Model:
    * Authentication
        * realm()
        * token()
        * ipAddress()
        * occurredOn()
        * validUntil()
        * isStillValid()
* Application\Service
    * AuthenticationService
        * isAuthenticated(Authentication $authentication): bool
        * _or
        * returns [AuthenticationResult](https://github.com/zendframework/zend-authentication/blob/master/src/Result.php)
            * isValid()
            * code()
    * AuthenticationRepository
        * findByRealmTokenAndIpAddress: Authentication

## General

* provides rest endpoint like "create-token-authentication" to get a valid token (via POST)
* provides rest endpoint like "delete-token-authentication" to invalidate token (via DELETE)
* token genertated by sha1sum(timestamp + salt + key)
* header field "Authorization"
    * https://www.httpwatch.com/httpgallery/authentication/
    * https://en.wikipedia.org/wiki/List_of_HTTP_header_fields
    * https://www.iana.org/assignments/message-headers/message-headers.xml#perm-headers
    * https://tools.ietf.org/html/rfc7235
    * https://stackoverflow.com/questions/7802116/custom-http-authorization-header
    * https://en.wikipedia.org/wiki/Basic_access_authentication#Server_side
    * https://en.wikipedia.org/wiki/Basic_access_authentication#Client_side
    * https://en.wikipedia.org/wiki/Digest_access_authentication
    * https://github.com/zendframework/zend-authentication/blob/de37d3411d7938d3955cc0d73ae06373afc1b1f3/doc/book/zend.authentication.adapter.digest.md
    * https://github.com/phpmasterdotcom/UnderstandingHTTPDigest
    * https://tools.ietf.org/html/rfc3261#page-29
    * https://en.wikipedia.org/wiki/Session_Initiation_Protocol
    * https://en.wikipedia.org/wiki/Secure_Remote_Password_protocol

# Authentication

```
Authorization: <realm> <token>
Authorization: <application-id> sha1sum<real+user+password+salt>
```
* [digest](https://github.com/zendframework/zend-authentication/blob/master/src/Adapter/Digest.php) but not with an hard wired file as storage

# Notes

* trying to use [zend-expressive](https://zend-expressive.readthedocs.org/en/latest/)

# Todo

* implement usage of `zendframework/zend-cache`
* investiage usage of `zendframework/zend-mvc`

# Links

* http://www.django-rest-framework.org/api-guide/authentication/
* https://github.com/firebase/firebase-token-generator-php
* https://github.com/zfcampus/zf-oauth2
    * https://github.com/zfcampus/zf-oauth2/blob/master/src/Adapter/BcryptTrait.php
* https://de.wikipedia.org/wiki/HTTP-Authentifizierung
* https://en.wikipedia.org/wiki/List_of_HTTP_header_fields
* https://www.owasp.org/index.php/List_of_useful_HTTP_headers
* https://en.wikipedia.org/wiki/Representational_state_transfer
* https://github.com/RhubarbPHP/Scaffold.TokenBasedRestApi
* https://github.com/tappleby/laravel-auth-token
* https://github.com/unautreweb/symfony2-secured-rest-api
* https://github.com/jeins/basic-rest-api
* https://github.com/shahzada-saddam/yii2-rest-module
* https://github.com/messagebird/php-rest-api
* https://github.com/zfcampus/zf-mvc-auth
