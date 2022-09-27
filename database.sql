CREATE DATABASE IF NOT EXISTS laravel_master;

use laravel_master;

create table IF NOT EXISTS users(
    id          INT(255) AUTO_INCREMENT NOT NULL,
    role        VARCHAR(20),
    name        VARCHAR(100),
    surname     VARCHAR(200),
    nick        VARCHAR(100),
    email       VARCHAR(255),
    password    VARCHAR(255),
    image       VARCHAR(255),
    created_at  DATETIME,
    updated_at  DATETIME,
    remember_token VARCHAR(255),
    constraint pk_users PRIMARY KEY(id)
)ENGINE=InnoDB;

insert into users values(null,'user','sergio','sanchez','sesio','s@gmail.com','123',null,CURTIME(),CURTIME(),NULL);
insert into users values(null,'user','pedro','lopez','pelopez','lopez@gmail.com','123',null,CURTIME(),CURTIME(),NULL);

create table IF NOT EXISTS images(
    id          INT(255) AUTO_INCREMENT NOT NULL,
    user_id     INT(255),
    image_path  VARCHAR(255),
    description TEXT,
    created_at  DATETIME,
    updated_at  DATETIME,
    constraint pk_images PRIMARY KEY(id),
    constraint fk_images_users FOREIGN KEY(user_id) REFERENCES users(id)
)ENGINE=InnoDB;

insert into images values(null,1,'test.png','descripcion de prueba 1',curtime(),curtime());
insert into images values(null,1,'test2.png','descripcion de prueba 2',curtime(),curtime());
insert into images values(null,2,'test3.png','descripcion de prueba 3',curtime(),curtime());



create table IF NOT EXISTS comments(
    id          INT(255) AUTO_INCREMENT NOT NULL,
    user_id     INT(255),
    image_id    INT(255),
    content     TEXT,
    created_at  DATETIME,
    updated_at  DATETIME,
    constraint pk_comments PRIMARY KEY(id),
    constraint fk_comments_users FOREIGN KEY(user_id) REFERENCES users(id),
    constraint fk_comments_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDB;

insert into comments values(null, 1, 1, 'Buena foto',curtime(),curtime());
insert into comments values(null, 2, 1, 'Buena foto hermano',curtime(),curtime());
insert into comments values(null, 1, 2, 'Buena foto gaaa',curtime(),curtime());
insert into comments values(null, 2, 2, 'Ese no es mi hemano?',curtime(),curtime());

create table IF NOT EXISTS likes(
    id          INT(255) AUTO_INCREMENT NOT NULL,
    user_id     INT(255),
    image_id    INT(255),
    created_at  DATETIME,
    updated_at  DATETIME,
    constraint pk_likes PRIMARY KEY(id),
    constraint fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
    constraint fk_likes_images FOREIGN KEY(image_id) REFERENCES images(id)
)ENGINE=InnoDB;

insert into likes values(null, 1, 1, curtime(),curtime());
insert into likes values(null, 1, 2, curtime(),curtime());
insert into likes values(null, 2, 1, curtime(),curtime());
insert into likes values(null, 2, 2, curtime(),curtime());