CREATE TABLE users (
    id          NUMERIC(11)     NOT NULL AUTO_INCREMENT,
    username    VARCHAR(100)    NOT NULL,
    email       VARCHAR(100)    NOT NULL,
    password    VARCHAR(100)    NOT NULL,
    CONSTRAINT users_pk
        PRIMARY KEY id
);

-- ÉCOLES, par exemple : IUT Lannion
CREATE TABLE schools (
    id      NUMERIC(3)      NOT NULL AUTO_INCREMENT,
    name    VARCHAR(50)     NOT NULL
    CONSTRAINT schools_pk
        PRIMARY KEY id
);

-- GROUPES, par exemple : DUT Informatique, LP Web
CREATE TABLE groups (
    id      NUMERIC(3)      NOT NULL AUTO_INCREMENT,
    name    VARCHAR(50)     NOT NULL,
    CONSTRAINT groups_pk
        PRIMARY KEY id
);