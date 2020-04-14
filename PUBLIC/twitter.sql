CREATE DATABASE twitter COLLATE utf8_unicode_ci;
CREATE TABLE usuarios(
	id int not null primary key auto_increment,
    nome varchar(100) not null,
    email varchar(150) not null,
    senha varchar(255) not null,
    nome_arquivo_usuario varchar(255)
);


CREATE TABLE tweets(
        id int not null PRIMARY KEY auto_increment,
        id_usuario int not null,
        tweet varchar(280) not null,
        data datetime default current_timestamp,
        nome_arquivo_tweet varchar(255),
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
);

CREATE TABLE usuarios_seguidores(
        id int not null primary key auto_increment,
        id_usuario_seguidor int not null,
        id_usuario_seguido int not null
);


SELECT * FROM usuarios;
SELECT * FROM tweets;