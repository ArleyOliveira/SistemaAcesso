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

CREATE VIEW disciplinas as select d.codigo as disciplinaCodigo, d.nome as disciplina, c.codigo as cursoCodigo, c.nome as curso from disciplina d join curso c on d.curso = c.codigo;

