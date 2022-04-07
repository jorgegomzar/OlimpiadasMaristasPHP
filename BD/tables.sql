DROP TABLE IF EXISTS voley;

CREATE TABLE voley (
    voley_id INT AUTO_INCREMENT,
    eq1 VARCHAR(20) NOT NULL,
    eq2 VARCHAR(20) NOT NULL,
    fecha DATETIME NOT NULL,
    r1 INT DEFAULT 0,
    r2 INT DEFAULT 0,
    PRIMARY KEY (voley_id)
);

INSERT INTO voley (eq1, eq2, fecha) VALUES
    ('burgos','ccv', '2022-03-31 18:00:00'),
    ('salamanca','la inmaculada', '2022-03-31 18:00:00'),
    ('león','ourense', '2022-03-31 18:30:00'),

    ('ccv','palencia', '2022-03-31 18:30:00'),
    ('burgos','ourense', '2022-03-31 19:00:00'),
    ('salamanca','león', '2022-03-31 19:00:00'),

    ('la inmaculada','palencia', '2022-03-31 19:30:00'),
    ('ccv','ourense', '2022-03-31 19:30:00'),
    ('burgos','salamanca', '2022-04-01 10:30:00'),

    ('ourense','palencia', '2022-04-01 10:30:00'),
    ('la inmaculada','león', '2022-04-01 11:00:00'),
    ('ccv','salamanca', '2022-04-01 11:00:00'),

    ('león','palencia', '2022-04-01 16:00:00'),
    ('ourense','salamanca', '2022-04-01 16:00:00'),
    ('la inmaculada','burgos', '2022-04-01 17:00:00'),

    ('salamanca','palencia', '2022-04-01 17:30:00'),
    ('león','burgos', '2022-04-01 18:00:00'),
    ('la inmaculada','ccv', '2022-04-01 18:30:00'),

    ('burgos','palencia', '2022-04-02 10:30:00'),
    ('león','ccv', '2022-04-02 11:00:00'),
    ('ourense','la inmaculada', '2022-04-02 11:30:00');

SELECT * FROM voley;


DROP TABLE IF EXISTS basket;

CREATE TABLE basket (
    basket_id INT AUTO_INCREMENT,
    eq1 VARCHAR(20) NOT NULL,
    eq2 VARCHAR(20) NOT NULL,
    fecha DATETIME NOT NULL,
    r1 INT DEFAULT 0,
    r2 INT DEFAULT 0,
    PRIMARY KEY (basket_id)
);

INSERT INTO basket (eq1, eq2, fecha) VALUES
    ('la inmaculada','palencia', '2022-03-31 18:00:00'),
    ('ccv','ourense', '2022-03-31 18:30:00'),
    ('burgos','salamanca', '2022-03-31 19:00:00'),

    ('ourense','palencia', '2022-03-31 19:30:00'),
    ('la inmaculada','león', '2022-04-01 10:00:00'),
    ('ccv','salamanca', '2022-04-01 10:30:00'),

    ('burgos','ccv', '2022-04-01 11:00:00'),
    ('salamanca','la inmaculada', '2022-04-01 16:00:00'),
    ('león','ourense', '2022-04-01 16:30:00'),

    ('ccv','palencia', '2022-04-01 17:00:00'),
    ('burgos','ourense', '2022-04-01 17:00:00'),
    ('salamanca','león', '2022-04-01 17:30:00'),

    ('burgos','palencia', '2022-04-01 17:30:00'),
    ('león','ccv', '2022-04-01 18:00:00'),
    ('ourense','la inmaculada', '2022-04-01 18:30:00'),

    ('león','palencia', '2022-04-01 18:30:00'),
    ('ourense','salamanca', '2022-04-01 18:30:00'),
    ('la inmaculada','burgos', '2022-04-01 19:00:00'),
    
    ('salamanca','palencia', '2022-04-02 10:30:00'),
    ('león','burgos', '2022-04-02 11:00:00'),
    ('la inmaculada','ccv', '2022-04-02 11:30:00');

SELECT * FROM basket;

DROP TABLE IF EXISTS futsal;

CREATE TABLE futsal (
    futsal_id INT AUTO_INCREMENT,
    eq1 VARCHAR(20) NOT NULL,
    eq2 VARCHAR(20) NOT NULL,
    fecha DATETIME NOT NULL,
    r1 INT DEFAULT 0,
    r2 INT DEFAULT 0,
    PRIMARY KEY (futsal_id)
);

INSERT INTO futsal (eq1, eq2, fecha) VALUES
    ('salamanca','palencia', '2022-03-31 18:00:00'),
    ('león','burgos', '2022-03-31 18:00:00'),
    ('la inmaculada','ccv', '2022-03-31 18:30:00'),

    ('burgos','palencia', '2022-03-31 18:30:00'),
    ('león','ccv', '2022-03-31 19:00:00'),
    ('ourense','la inmaculada', '2022-03-31 19:00:00'),

    ('ccv','palencia', '2022-03-31 19:30:00'),
    ('burgos','ourense', '2022-03-31 19:30:00'),
    ('salamanca','león', '2022-04-01 10:30:00'),

    ('burgos','ccv', '2022-04-01 10:30:00'),
    ('salamanca','la inmaculada', '2022-04-01 11:00:00'),
    ('león','ourense', '2022-04-01 11:00:00'),

    ('la inmaculada','palencia', '2022-04-01 16:30:00'),
    ('ccv','ourense', '2022-04-01 17:00:00'),
    ('burgos','salamanca', '2022-04-01 17:30:00'),

    ('ourense','palencia', '2022-04-01 18:00:00'),
    ('la inmaculada','león', '2022-04-01 18:30:00'),
    ('ccv','salamanca', '2022-04-01 19:00:00'),

    ('león','palencia', '2022-04-02 10:30:00'),
    ('ourense','salamanca', '2022-04-02 11:00:00'),
    ('la inmaculada','burgos', '2022-04-02 11:30:00');

SELECT * FROM futsal;

DROP TABLE IF EXISTS mods;

CREATE TABLE mods (
    mod_id INT AUTO_INCREMENT,
    username VARCHAR(20) NOT NULL,
    passwd VARCHAR(20) NOT NULL,
    PRIMARY KEY (mod_id)
);

INSERT INTO mods (username, passwd) VALUES
    ('editor', '3712e72dec');

SELECT * FROM mods;

DROP TABLE IF EXISTS atletismo;

CREATE TABLE atletismo (
    atletismo_id INT AUTO_INCREMENT,
    eq VARCHAR(20) NOT NULL,
    posicion INT DEFAULT 0,
    categoria VARCHAR(20) NOT NULL,
    PRIMARY KEY (atletismo_id)
);

INSERT INTO atletismo (eq, categoria) VALUES
    ('burgos', '100m'),
    ('burgos', '200m'),
    ('burgos', '400m'),

    ('ccv', '100m'),
    ('ccv', '200m'),
    ('ccv', '400m'),
    
    ('salamanca', '100m'),
    ('salamanca', '200m'),
    ('salamanca', '400m'),

    ('la inmaculada', '100m'),
    ('la inmaculada', '200m'),
    ('la inmaculada', '400m'),

    ('león', '100m'),
    ('león', '200m'),
    ('león', '400m'),

    ('ourense', '100m'),
    ('ourense', '200m'),
    ('ourense', '400m'),

    ('palencia', '100m'),
    ('palencia', '200m'),
    ('palencia', '400m');


SELECT * FROM atletismo;


DROP TABLE IF EXISTS clasificacion;

CREATE TABLE clasificacion (
    clasificacion_id INT AUTO_INCREMENT,
    eq VARCHAR(20) NOT NULL,
    puntos INT DEFAULT 0,
    PRIMARY KEY (clasificacion_id)
);

INSERT INTO clasificacion (eq, puntos) VALUES
    ('burgos', 0),
    ('ccv', 0),
    ('salamanca', 0),
    ('la inmaculada', 0),
    ('león', 0),
    ('ourense', 0),
    ('palencia', 0);

SELECT * FROM clasificacion;