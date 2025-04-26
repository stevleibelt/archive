
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- net_bazzline_identification_service_identities
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS net_bazzline_identification_service_identities;

CREATE TABLE net_bazzline_identification_service_identities
(
    id CHAR(36) NOT NULL,
    name VARCHAR(40) NOT NULL,
    password CHAR(40) NOT NULL,
    user_id CHAR(36) NOT NULL,
    created_at DATE(40) NOT NULL,
    updated_at DATE(40) NOT NULL,
    valid_until DATE(40) NOT NULL,
    PRIMARY KEY (id),
    INDEX loginIndex (login),
    INDEX net_bazzline_identification_service_identities_FI_1 (user_id),
    CONSTRAINT net_bazzline_identification_service_identities_FK_1
        FOREIGN KEY (user_id)
        REFERENCES net_bazzline_identification_service_users (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- net_bazzline_identification_service_users
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS net_bazzline_identification_service_users;

CREATE TABLE net_bazzline_identification_service_users
(
    id CHAR(36) NOT NULL,
    firstName VARCHAR(40) NOT NULL,
    lastName VARCHAR(40) NOT NULL,
    email VARCHAR(80) NOT NULL,
    is_active TINYINT(1) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

-- ---------------------------------------------------------------------
-- net_bazzline_identification_service_services
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS net_bazzline_identification_service_services;

CREATE TABLE net_bazzline_identification_service_services
(
    id CHAR(36) NOT NULL,
    base_url VARCHAR(100) NOT NULL,
    token CHAR(40) NOT NULL,
    created_at DATE(40) NOT NULL,
    updated_at DATE(40) NOT NULL,
    valid_until DATE(40) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB CHARACTER SET='utf8';

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
