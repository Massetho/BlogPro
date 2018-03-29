SET NAMES utf8;

DROP TABLE IF EXISTS admin;
DROP TABLE IF EXISTS article;
DROP TABLE IF EXISTS category;


CREATE TABLE admin (
  id_admin INT AUTO_INCREMENT,
  firstname VARCHAR(45) NOT NULL,
  lastname VARCHAR(45) NOT NULL,
  date_created DATETIME NOT NULL,
  email VARCHAR(255) NOT NULL,
  phone INT(10) NOT NULL,
  password VARCHAR(255) NOT NULL,
  access_level VARCHAR(45) NOT NULL DEFAULT 0,
  token VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (id_admin),
  UNIQUE (email),
  UNIQUE (phone),
  UNIQUE (password)
);

INSERT INTO admin (id_admin, firstname, lastname, date_created, email, phone, password)
VALUES (1, 'Admin', 'BlogPro', NOW(), 'admin@blopro.com', 0600000000, '$2y$10$eKBqFzznilmFbKYxbKtCduHLuxKcIUS2TqG750C10EsKcF54BmWom');

CREATE TABLE category (
  id_category INT AUTO_INCREMENT,
  name VARCHAR(45),
  PRIMARY KEY (id_category)
);

INSERT INTO category (id_category, name)
VALUES (1, 'Le blog'),
  (2, 'Mes projets');

CREATE TABLE article (
  id_article INT AUTO_INCREMENT,
  article_category INT,
  title VARCHAR(150) NOT NULL,
  introduction TEXT,
  body TEXT,
  date_created DATETIME NOT NULL,
  PRIMARY KEY (id_article),
  CONSTRAINT fk_article_category
    FOREIGN KEY (article_category)
    REFERENCES category(id_category),
);

INSERT INTO article (id_article, article_category, title, introduction, body, date_created)
VALUES (1, 1, 'Bonjour Monde!', 'Voici mon premier article pour mon site personnel développé entièrement en PHP orienté objet.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin faucibus quam, nec fringilla dui commodo sit amet. Pellentesque vehicula turpis vitae dolor imperdiet, sed cursus ex pharetra. Vivamus varius ligula leo, at pretium nisl convallis vel. Cras ut tortor euismod, malesuada velit sit amet, semper nisl. Suspendisse euismod nisi in neque sollicitudin, et facilisis nibh semper. Pellentesque bibendum finibus pretium. In id tristique tellus, vitae cursus eros. Nam aliquam rutrum eros in ultricies.', NOW());


CREATE TABLE comment (
  id_comment INT AUTO_INCREMENT,
  comment_admin INT NOT NULL,
  comment_article INT NOT NULL,
  content VARCHAR(1000),
  validate INT(1) DEFAULT 0,
  id_parent INT,
  PRIMARY KEY (id_comment),
  CONSTRAINT fk_comment_admin
    FOREIGN KEY (comment_admin)
    REFERENCES admin(id_admin),
  CONSTRAINT fk_comment_article
    FOREIGN KEY (comment_article)
    REFERENCES article(id_article),
  CONSTRAINT fk_id_parent
    FOREIGN KEY (id_parent)
    REFERENCES comment(id_comment)
);