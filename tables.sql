CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(255) NOT NULL,
email VARCHAR(255) NOT NULL,
password VARCHAR(255) NOT NULL
);

INSERT INTO users VALUES (null, 'mflasquin','maxime.flasquin@gmail.com','password');
INSERT INTO users VALUES (null, 'test','test@gmail.com','password2');
INSERT INTO users VALUES (null, 'test2','TESTé@GMAIL;COM','password3');
INSERT INTO users VALUES (null, 'nono','nono@gmail.com','nono');
INSERT INTO users VALUES (null, 'essai','esa@fot.com','esa');
INSERT INTO users VALUES (null, 'a','a@a.a','$2y$12$hO0FnYG8UHSAqvrUcUo2qOltJk9W7Pem5dzxa/.uT1JemsfGlxTUi');
INSERT INTO users VALUES (null, 'b','b@b.a','$2y$12$tK2DZveX8ZI5OYl9no6w7edQqpPZLqfMEiG21uCKPTyGI3uekXzi.');
INSERT INTO users VALUES (null, 'c','c@c.c','$2y$12$.xonyHDayuZn.q8R2xSuSuSmR0va9nBTCLSwszhpRbiiv4qs8ZaJu');
