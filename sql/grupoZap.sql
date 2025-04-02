/* CRIANDO A BASE DE DADOS */
create database whatsapp
default character set utf8
default collate utf8_general_ci;


/* CRIANDO TABELA DE USUÁRIO */
create table usuario (
id_user int unsigned not null AUTO_INCREMENT,
primary key (id_user),
nome_user varchar(30) not null,
recado varchar(100) not null default 'Hey there, I´m using whats app',
url_foto varchar(100),
data_cadastro date not null,
hora_cadastro time not null
)DEFAULT charset = utf8;


/* CRIANDO TABELA DE GRUPO */
create table grupo_whatsapp(
id_grupo int unsigned not null AUTO_INCREMENT,
PRIMARY KEY(id_grupo),
nome_grupo varchar(30) not null unique,
descricao varchar(40),
criado_em date not null,
url_imagem varchar(100)
)DEFAULT charset = utf8;


/* CRIANDO TABELA DE INTEGRANTES DE GRUPO */
create table integrante (
id_integrante int unsigned not null AUTO_INCREMENT,
PRIMARY KEY(id_integrante),
id_user int unsigned not null,
FOREIGN KEY(id_user) REFERENCES usuario(id_user),
id_grupo int unsigned not null,
FOREIGN KEY(id_grupo) REFERENCES grupo_whatsapp(id_grupo)
on DELETE CASCADE
on UPDATE CASCADE
)DEFAULT charset = utf8;


/* OBSERVAÇÕES

* ON DELETE CASCADE - Pq se deletar o grupo (id_grupo) tem que deletar os integrantes também
* ON UPDATE CASCADE - Se mudar o id na tabela de grupo, tem que mudar na tabela de integrante também