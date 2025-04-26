# API and Routes

Based on [http status code](https://en.wikipedia.org/wiki/List_of_HTTP_status_codes) and [rest](https://en.wikipedia.org/wiki/Representational_state_transfer).

## Basic Routes

* /user/authentication
* /user/registration
* /media/artist
* /media/distributor
* /media/edition
* /media/platform
* /media/genre
* /media/language
* /media/search
* /media/title
* /media/type
* /media/audio
* /media/book
* /media/comment
* /media/game
* /media/video

## authentication

* GET - <string> login, <string> password
    * log in
    * returns 200 and <string> token on success
    * returns 401 on failure
* POST - <string> login, <string> password
    * create new log in
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> login, <string> password
    * update password
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> login, <string> password
    * delete log in
    * returns 200 on success
    * returns 400/401/403/404 on failure

## user

* GET - <string> id
    * returns 200 and 
        * <string> first name 
        * <string last name>
        * <string> email
    * returns 401 on failure
* POST - <string> first name, <string last name>, <string> email
    * create new user
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> first name, <string last name>, <string> email
    * update user
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete user
    * returns 200 on success
    * returns 400/401/403/404 on failure

## media

### artist

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new artist
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update artist
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete artist
    * returns 200 on success
    * returns 400/401/403/404 on failure

### distributor

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new distributor
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update distributor
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete distributor
    * returns 200 on success
    * returns 400/401/403/404 on failure

### edition

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new edition
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update edition
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete edition
    * returns 200 on success
    * returns 400/401/403/404 on failure

### platform

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new platform
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update platform
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete platform
    * returns 200 on success
    * returns 400/401/403/404 on failure

### genre

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new genre
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update genre
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete genre
    * returns 200 on success
    * returns 400/401/403/404 on failure

### language

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new language
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update language
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete language
    * returns 200 on success
    * returns 400/401/403/404 on failure

### type

* GET - <string> id
    * returns 200 and <string> name
    * returns 401 on failure
* POST - <string> name
    * create new type
    * returns 201 on success
    * returns 400/403 on failure
* PUT - <string> id, <string> name
    * update type
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete type
    * returns 200 on success
    * returns 400/401/403/404 on failure

### audio

* GET - <string> id
    * returns 200 and 
        * <string> name
        * distributor
            * <string> name
            * <string> id
        * edition 
            * <string> name
            * <string> id
        * <string> type name
            * <string> name
            * <string> id
        [ * <string> user id
            * <string> first name
            * <string> last name
            * <string> id
        ]
        * <int> age limit
        * <int> number of discs
        * <int> created at
        * <int> released at
        * collection of audio track
            * track
                * <string> id
                * <string> name
                * artist
                    * <string> name
                    * <string> id
                * <int> number of play
                * <int> number of disc
                * <int> duration
                * distributor
                    * <string> name
                    * <string> id
                * edition 
                    * <string> name
                    * <string> id
                * <string> type name
                    * <string> name
                    * <string> id
                [ * <string> user id
                    * <string> first name
                    * <string> last name
                    * <string> id
                ]
    * returns 401 on failure
* POST -    * <string> name
            * distributor
                * <string> name
                * <string> id
            * edition 
                * <string> name
                * <string> id
            * <string> type name
                * <string> name
                * <string> id
            [ * <string> user id
                * <string> first name
                * <string> last name
                * <string> id
            ]
            * <int> age limit
            * <int> number of discs
            * <int> created at
            * <int> released at
            * collection of audio track
                * track
                    * <string> id
                    * <string> name
                    * artist
                        * <string> name
                        * <string> id
                    * <int> number of play
                    * <int> number of disc
                    * <int> duration
                    * distributor
                        * <string> name
                        * <string> id
                    * edition 
                        * <string> name
                        * <string> id
                    * <string> type name
                        * <string> name
                        * <string> id
                    [ * <string> user id
                        * <string> first name
                        * <string> last name
                        * <string> id
                    ]
    * create audio
    * returns 201 on success
    * returns 400/403 on failure
* PUT - * <string> id
            * distributor
                * <string> name
                * <string> id
            * edition 
                * <string> name
                * <string> id
            * <string> type name
                * <string> name
                * <string> id
            [ * <string> user id
                * <string> first name
                * <string> last name
                * <string> id
            ]
            * <int> age limit
            * <int> number of discs
            * <int> created at
            * <int> released at
            * collection of audio track
                * track
                    * <string> id
                    * <string> name
                    * artist
                        * <string> name
                        * <string> id
                    * <int> number of play
                    * <int> number of disc
                    * <int> duration
                    * distributor
                        * <string> name
                        * <string> id
                    * edition 
                        * <string> name
                        * <string> id
                    * <string> type name
                        * <string> name
                        * <string> id
                    [ * <string> user id
                        * <string> first name
                        * <string> last name
                        * <string> id
                    ]
    * update audio
    * returns 200 on success
    * returns 400/401/403 on failure
* DELETE - <string> id
    * delete audio
    * returns 200 on success
    * returns 400/401/403/404 on failure

### audio track

### book

### video

### game

### comment 


# thoughts

* for first revision, any media only available below user since they are coupled to the user?
    * /user
    * /user/<id>
    * /user/<id>/media
    * /user/<id>/media/<id>
    * /user/<id>/media/audio
    * /user/<id>/media/audio/<id>
    * /user/<id>/media
