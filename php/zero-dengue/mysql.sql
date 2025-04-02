/* CRIANDO A BASE DE DADOS CONFIGURADA PARA O PORTUGUÊS */
create database zero_dengue
default character set utf8
default collate utf8_general_ci;


/* CRIANDO A TABELA USUARIO */
create table usuario(
id_usuario int unsigned not null AUTO_INCREMENT,
PRIMARY KEY(id_usuario),
permissao tinyint(1) unsigned not null default 1,
ativo tinyint(1) unsigned not null default 1,
cpf bigint unsigned not null unique,
nome varchar(150) not null,
endereco varchar(150) not null,
cidade varchar(100) not null,
estado varchar(2) not null,
sexo ENUM('m','f'),
telefone bigint(11) unsigned,
email varchar(150) not null unique,
senha varchar(200) not null,
index (senha),
foto varchar(150)
) DEFAULT charset = utf8;


/* CRIANDO A TABELA DENUNCIA */
create table denuncia(
id_denuncia int unsigned not null AUTO_INCREMENT,
PRIMARY KEY(id_denuncia),
id_usuario int unsigned not null,
FOREIGN KEY(id_usuario) REFERENCES usuario(id_usuario),
status tinyint(1) unsigned not null,
index (status),
seriedade tinyint(1) unsigned not null,
index (seriedade),
abertura date not null,
index (abertura),
fechamento date not null,
endereco varchar(150) not null,
index (endereco),
cidade varchar(100) not null,
index (cidade),
estado varchar(2) not null,
index (estado),
descricao varchar(1000) not null,
foto varchar(150)
) default charset = utf8;