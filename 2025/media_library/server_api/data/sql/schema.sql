
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- media_library_user_identities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_user_identities;

CREATE TABLE media_library_user_identities
(
    id CHAR(36) NOT NULL,
    login VARCHAR(40) NOT NULL,
    password CHAR(40) NOT NULL,
    user_id CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    INDEX loginIndex (login),
    INDEX media_library_user_identities_FI_1 (user_id),
    CONSTRAINT media_library_user_identities_FK_1
        FOREIGN KEY (user_id)
        REFERENCES media_library_user_users (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_user_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_user_users;

CREATE TABLE media_library_user_users
(
    id CHAR(36) NOT NULL,
    firstName VARCHAR(40) NOT NULL,
    lastName VARCHAR(40) NOT NULL,
    email VARCHAR(80) NOT NULL,
    is_active TINYINT(1) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_common
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_common;

CREATE TABLE media_library_media_common
(
    id CHAR(36) NOT NULL,
    distributor_id CHAR(36) NOT NULL,
    edition_id CHAR(36) NOT NULL,
    type_id CHAR(36) NOT NULL,
    user_id CHAR(36) NOT NULL,
    age_limit TINYINT(2) DEFAULT 0 NOT NULL,
    create_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    release_date DATETIME DEFAULT '0000-00-00 00:00:00' NOT NULL,
    name VARCHAR(120) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name),
    INDEX media_library_media_common_FI_1 (distributor_id),
    INDEX media_library_media_common_FI_2 (edition_id),
    INDEX media_library_media_common_FI_3 (type_id),
    INDEX media_library_media_common_FI_4 (user_id),
    CONSTRAINT media_library_media_common_FK_1
        FOREIGN KEY (distributor_id)
        REFERENCES media_library_media_distributor (id),
    CONSTRAINT media_library_media_common_FK_2
        FOREIGN KEY (edition_id)
        REFERENCES media_library_media_edition (id),
    CONSTRAINT media_library_media_common_FK_3
        FOREIGN KEY (type_id)
        REFERENCES media_library_media_type (id),
    CONSTRAINT media_library_media_common_FK_4
        FOREIGN KEY (user_id)
        REFERENCES media_library_user_users (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_artists
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_artists;

CREATE TABLE media_library_media_artists
(
    id CHAR(36) NOT NULL,
    name VARCHAR(80) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_audio
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_audio;

CREATE TABLE media_library_media_audio
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    number_of_discs TINYINT(2) DEFAULT 1,
    PRIMARY KEY (id),
    INDEX media_library_media_audio_FI_1 (media_id),
    CONSTRAINT media_library_media_audio_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_audio_track
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_audio_track;

CREATE TABLE media_library_media_audio_track
(
    id CHAR(36) NOT NULL,
    name VARCHAR(80) NOT NULL,
    audio_id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    number_of_play TINYINT(2) NOT NULL,
    number_of_disc TINYINT(2) DEFAULT 1,
    duration INTEGER(6),
    PRIMARY KEY (id),
    INDEX nameIndex (name),
    INDEX media_library_media_audio_track_FI_1 (audio_id),
    CONSTRAINT media_library_media_audio_track_FK_1
        FOREIGN KEY (audio_id)
        REFERENCES media_library_media_audio (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_book
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_book;

CREATE TABLE media_library_media_book
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    number_of_pages SMALLINT(4) NOT NULL,
    isbn_10 CHAR(10) DEFAULT '',
    isbn_13 CHAR(13) DEFAULT '',
    PRIMARY KEY (id),
    INDEX media_library_media_book_FI_1 (media_id),
    CONSTRAINT media_library_media_book_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_video
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_video;

CREATE TABLE media_library_media_video
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    duration SMALLINT(4) NOT NULL,
    number_of_discs TINYINT(2) DEFAULT 1 NOT NULL,
    PRIMARY KEY (id),
    INDEX media_library_media_video_FI_1 (media_id),
    CONSTRAINT media_library_media_video_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_game
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_game;

CREATE TABLE media_library_media_game
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    platform_id CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    INDEX media_library_media_game_FI_1 (media_id),
    INDEX media_library_media_game_FI_2 (platform_id),
    CONSTRAINT media_library_media_game_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id),
    CONSTRAINT media_library_media_game_FK_2
        FOREIGN KEY (platform_id)
        REFERENCES media_library_media_platform (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_comment
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_comment;

CREATE TABLE media_library_media_comment
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    parent_comment_id CHAR(36) NOT NULL,
    user_id CHAR(36) NOT NULL,
    create_date DATETIME,
    comment TEXT NOT NULL,
    PRIMARY KEY (id),
    INDEX media_library_media_comment_FI_1 (media_id),
    INDEX media_library_media_comment_FI_2 (user_id),
    CONSTRAINT media_library_media_comment_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id),
    CONSTRAINT media_library_media_comment_FK_2
        FOREIGN KEY (user_id)
        REFERENCES media_library_user_users (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_distributor
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_distributor;

CREATE TABLE media_library_media_distributor
(
    id CHAR(36) NOT NULL,
    name VARCHAR(120) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_edition
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_edition;

CREATE TABLE media_library_media_edition
(
    id CHAR(36) NOT NULL,
    name VARCHAR(120) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_platform
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_platform;

CREATE TABLE media_library_media_platform
(
    id CHAR(36) NOT NULL,
    name VARCHAR(120) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_genre
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_genre;

CREATE TABLE media_library_media_genre
(
    id CHAR(36) NOT NULL,
    name VARCHAR(80) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_language
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_language;

CREATE TABLE media_library_media_language
(
    id CHAR(36) NOT NULL,
    name VARCHAR(120) NOT NULL,
    shortcut CHAR(3) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_type
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_type;

CREATE TABLE media_library_media_type
(
    id CHAR(36) NOT NULL,
    name VARCHAR(20) NOT NULL,
    PRIMARY KEY (id),
    INDEX nameIndex (name)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_to_artist
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_to_artist;

CREATE TABLE media_library_media_to_artist
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    artist_id CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    INDEX media_library_media_to_artist_FI_1 (media_id),
    INDEX media_library_media_to_artist_FI_2 (artist_id),
    CONSTRAINT media_library_media_to_artist_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id),
    CONSTRAINT media_library_media_to_artist_FK_2
        FOREIGN KEY (artist_id)
        REFERENCES media_library_media_artists (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_to_genre
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_to_genre;

CREATE TABLE media_library_media_to_genre
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    media_genre_id CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    INDEX media_library_media_to_genre_FI_1 (media_id),
    INDEX media_library_media_to_genre_FI_2 (media_genre_id),
    CONSTRAINT media_library_media_to_genre_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id),
    CONSTRAINT media_library_media_to_genre_FK_2
        FOREIGN KEY (media_genre_id)
        REFERENCES media_library_media_genre (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- media_library_media_to_language
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS media_library_media_to_language;

CREATE TABLE media_library_media_to_language
(
    id CHAR(36) NOT NULL,
    media_id CHAR(36) NOT NULL,
    media_language_id CHAR(36) NOT NULL,
    PRIMARY KEY (id),
    INDEX media_library_media_to_language_FI_1 (media_id),
    INDEX media_library_media_to_language_FI_2 (media_language_id),
    CONSTRAINT media_library_media_to_language_FK_1
        FOREIGN KEY (media_id)
        REFERENCES media_library_media_common (id),
    CONSTRAINT media_library_media_to_language_FK_2
        FOREIGN KEY (media_language_id)
        REFERENCES media_library_media_language (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
