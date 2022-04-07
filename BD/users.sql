DROP USER IF EXISTS 'readonly'@'localhost';
DROP USER IF EXISTS 'updateonly'@'localhost';
DROP USER IF EXISTS 'administrador'@'localhost';


CREATE USER 'readonly'@'localhost' IDENTIFIED BY 'AAAAAAAAAAA';
GRANT SELECT ON olimpiadas.* TO 'readonly'@'localhost';
FLUSH PRIVILEGES;

CREATE USER 'updateonly'@'localhost' IDENTIFIED BY 'BBBBBBBBBBB';
GRANT SELECT,UPDATE ON olimpiadas.* TO 'updateonly'@'localhost';
FLUSH PRIVILEGES;

CREATE USER 'administrador'@'localhost' IDENTIFIED BY 'CCCCCCCCCC';
GRANT ALL ON olimpiadas.* TO 'administrador'@'localhost';
FLUSH PRIVILEGES;
