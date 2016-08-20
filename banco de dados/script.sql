create database sga;
use sga;
create table curso(
    codigo int auto_increment primary key,
    nome varchar(100) not null unique,
    area varchar(100) not null,
    f boolean default true
);

create table disciplina(
	codigo int auto_increment primary key,
	nome varchar(100) not null,
	curso int not null,
	foreign key(curso) references curso(codigo)    
);

create table usuario(
    nome varchar(100) not null,
    datanasc date not null,
    sexo varchar(20) not null,
    email varchar(100) not null primary key unique,
    senha varchar(32) not null,
    permissao int default 0,
    f boolean default true
);

create table professor(
    codigo int auto_increment not null primary key,
    nome varchar(100) not null,
    siape int not null unique,
    cpf varchar(11) not null unique,
    datanasc date not null,
    sexo varchar(20) not null,
    email varchar(100) not null unique,
    senha varchar(32) not null,
    permissao int default 0,
    f boolean default true
);

create table semestreletivo(
    codigo int auto_increment primary key,
    semetre int,
    ano int,
    status boolean default true
);

create table horario(
    codigo int auto_increment primary key,
    disciplina int not null,
    professor int,
    dia int not null,
    lab int not null,
    inicio time not null,
    fim time not null,
    semestreletivo int    
);

CREATE TABLE acessos(
    codigo int auto_increment PRIMARY KEY,
    professor int not null,
    laboratorio int not null,
    entrada TIMESTAMP not null DEFAULT CURRENT_TIMESTAMP,
    saida TIMESTAMP null,
    FOREIGN KEY (professor) REFERENCES professor(codigo)
);

CREATE VIEW disciplinas as select d.codigo as disciplinaCodigo, d.nome as disciplina, c.codigo as cursoCodigo, c.nome as curso from disciplina d join curso c on d.curso = c.codigo;

CREATE view acessosLab as Select p.nome as professor, laboratorio,  DATE_FORMAT(entrada, '%d/%m/%Y') as data, DATE_FORMAT(entrada, '%H:%i:%s') as entrada, DATE_FORMAT(saida, '%H:%i:%s') as saida from acessos a join professor p on a.professor = p.codigo ORDER by entrada;

