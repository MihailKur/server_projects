CREATE DATABASE IF NOT EXISTS appDB;

CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON appDB.* TO 'user'@'%';
FLUSH PRIVILEGES;
USE appDB;

DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS menu;

CREATE TABLE IF NOT EXISTS users
(
    ID       INT(11) NOT NULL AUTO_INCREMENT,
    name     VARCHAR(20) CHARACTER SET ascii NOT NULL,
    password VARCHAR(45) CHARACTER SET ascii NOT NULL,
    PRIMARY KEY (ID)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS menu
(
    ID          INT(10) NOT NULL AUTO_INCREMENT,
    name        VARCHAR(32)  NOT NULL,
    description VARCHAR(256) NOT NULL,
    price       INT(6) NOT NULL,
    PRIMARY KEY (ID)
);

INSERT INTO users (name, password)
VALUES ('admin', '{SHA}0DPiKuNIrrVmD8IUCuw1hQxNqZc=');


INSERT INTO menu (name, description, price)
VALUES ('ENGLISH BREAKFAST', 'Very tasty', 10);

INSERT INTO menu (name, description, price)
VALUES ('Black Americano', 'Served as a 12oz drink All our Barista prepared drinks are also available decaffeinated',
        3);

INSERT INTO menu (name, description, price)
VALUES ('Cappuccino', 'Served as a 12oz drink All our Barista prepared drinks are also available decaffeinated', 3);

INSERT INTO menu (name, description, price)
VALUES ('Latte', 'Served as a 12oz drink All our Barista prepared drinks are also available decaffeinated', 3);

INSERT INTO menu (name, description, price)
VALUES ('HOMEMADE SAUSAGE ROLL',
        'Honey roasted sausage meat mixed with caramelised onion chutney and wholegrain mustard wrapped in a flaky puff pastr',
        9);

INSERT INTO menu (name, description, price)
VALUES ('THE CLUB SANDWICH', 'Chicken Breast, Crispy Bacon, Lettuce, Tomato & Mayonnaise', 7);

INSERT INTO menu (name, description, price)
VALUES ('THE PLOUGHMAN SANDWICH', 'Cheddar Cheese, Honey Roasted Ham & Caramelised Onion Chutney', 7);