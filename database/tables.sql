create database catsitter;

create table usuarios(
    cod_usuario int auto_increment not null primary key,
    nome varchar(100) not null,
    sobrenome varchar(100) not null,
    dt_nascimento varchar(100) not null,
    genero varchar(50) not null,
    CONSTRAINT check_genero CHECK (genero IN ('Masculino', 'Feminino', 'Outro', 'Não informado')),
    cpf varchar(14) not null unique,
    foto VARCHAR(50) DEFAULT 'foto.png' NOT NULL,
    reg_date date NOT NULL default CURRENT_DATE,
    
    cep varchar(10) not null,
    rua varchar(100) not null,
    numero varchar(20) not null,
    cidade varchar(50) not null,
    estado varchar(100) not null,
    pais varchar(50) not null,
    complemento varchar(100),
    
    adm int DEFAULT 0 NOT NULL,
    
    email varchar(100) not null unique,
    confirma_email int default 0 not null,
    senha varchar(255) not null
)

create table telefones(
    telefone varchar(14) not null,
    cod_usuario int,
    primary key (telefone, cod_usuario),
    constraint fk_telefones foreign key (cod_usuario) references usuarios (cod_usuario) on delete cascade on update cascade);

create table gatos(
    cod_pet int AUTO_INCREMENT not null PRIMARY KEY,
    nome varchar(100) not null,
    dt_nascimento varchar(10),
   	sexo VARCHAR(20) NOT NULL,
    CONSTRAINT check_sexo CHECK (sexo IN ('Macho', 'Fêmea')),
    raca varchar(50) not null,
    foto VARCHAR(50) DEFAULT 'foto.png' NOT NULL,
    rotina varchar(500) default null,
    ficha_medica varchar(500) DEFAULT null,
    cod_usuario int,
    constraint fk_gatos FOREIGN KEY(cod_usuario) REFERENCES usuarios (cod_usuario) on delete cascade on update cascade)

create table cat_sitters(
	cod_catsitter int AUTO_INCREMENT not null,
    preco varchar(100) DEFAULT NULL,
    cod_usuario int,
    PRIMARY KEY (cod_catsitter, cod_usuario),
    constraint fk_cat_sitters FOREIGN KEY (cod_usuario) REFERENCES usuarios (cod_usuario) on update cascade)

CREATE TABLE chat (
    cod_mensagem INT AUTO_INCREMENT NOT NULL,
    mensagem VARCHAR(500) NOT NULL,
    data_hora DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cod_usuario INT,
    cod_catsitter INT,
    PRIMARY KEY (cod_mensagem),
    CONSTRAINT fk_chat_usuario FOREIGN KEY (cod_usuario) REFERENCES usuarios (cod_usuario) on delete cascade on update cascade,
    CONSTRAINT fk_chat_sitter FOREIGN KEY (cod_catsitter) REFERENCES cat_sitters (cod_catsitter) on delete cascade on update cascade
);

create table distintivos(
    cod_distintivo int AUTO_INCREMENT not null primary key,
    nome varchar(50) not null,
    descricao varchar(200) not null)

create table distintivo_catsitter(
    cod_usuario int,
    cod_distintivo int,
    PRIMARY KEY (cod_usuario, cod_distintivo),
    CONSTRAINT fk_relacao_sitter FOREIGN KEY (cod_usuario) REFERENCES usuarios (cod_usuario) on update cascade,
    CONSTRAINT fk_relacao_distintivo FOREIGN KEY (cod_distintivo) REFERENCES distintivos (cod_distintivo) on update cascade on delete cascade)

create table servicos(
    cod_servico int AUTO_INCREMENT not null PRIMARY KEY,
    nome varchar(50) not null,
    descricao varchar (200) not null)

create table agendamentos(
    cod_agendamento int AUTO_INCREMENT not null,
    dt_inicio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    dt_fim DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    cod_servico int, 
    cod_usuario int,
    cod_catsitter int,
    cod_pet int,
    PRIMARY KEY (cod_agendamento),
    CONSTRAINT fk_agend_servico FOREIGN KEY (cod_servico) REFERENCES servicos (cod_servico) on delete restrict on update cascade,
    CONSTRAINT fk_agend_usuario FOREIGN KEY (cod_usuario) REFERENCES usuarios (cod_usuario) on delete restrict on update cascade,
    CONSTRAINT fk_agend_sitter FOREIGN KEY (cod_catsitter) REFERENCES cat_sitters (cod_catsitter) on delete restrict on update cascade)

create table agendamento_pets(
    cod_agendamento int,
    cod_pet int,
    PRIMARY KEY (cod_agendamento, cod_pet),
    CONSTRAINT fk_agend_pet FOREIGN KEY (cod_agendamento) REFERENCES agendamentos (cod_agendamento) on delete cascade on update cascade,
    CONSTRAINT fk_pet FOREIGN KEY (cod_pet) REFERENCES gatos (cod_pet) on delete RESTRICT on update cascade);  
    
create table relatorios(
    cod_relatorio int AUTO_INCREMENT not null,
    check_in DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    check_out DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    descricao varchar(500) not null,
    foto_tipo varchar(20) not null,
    caminho varchar(20) not null,
    cod_agendamento int,
    PRIMARY KEY (cod_relatorio),
    CONSTRAINT fk_relatorio_agend FOREIGN KEY (cod_agendamento) REFERENCES agendamentos (cod_agendamento) on delete cascade on update cascade);

create table fotos(
    cod_foto int AUTO_INCREMENT not null,
    tipo varchar(50) not null,
    caminho varchar(50) not null,
    dt_criacao datetime default CURRENT_TIMESTAMP not null,
    cod_usuario int,
    PRIMARY KEY (cod_foto),
    CONSTRAINT fk_cod_usuario FOREIGN KEY (cod_usuario) REFERENCES usuarios (cod_usuario) on delete cascade on update cascade);

create table galeria_pet(
    cod_galeria int AUTO_INCREMENT not null,
    cod_foto int,
    cod_pet int,
    PRIMARY KEY (cod_galeria),
    CONSTRAINT fk_cod_foto FOREIGN KEY (cod_foto) REFERENCES fotos (cod_foto) on delete cascade on update cascade,
    CONSTRAINT fk_cod_pet FOREIGN KEY (cod_pet) REFERENCES gatos (cod_pet) on delete cascade on update cascade)

create table galeria_sitter(
    cod_galeria int AUTO_INCREMENT not null,
    cod_foto int,
    cod_catsitter int,
    PRIMARY KEY (cod_galeria),
    CONSTRAINT fk_cod_foto_sitter FOREIGN KEY (cod_foto) REFERENCES fotos (cod_foto) on delete cascade on update cascade,
    CONSTRAINT fk_codsitter FOREIGN KEY (cod_catsitter) REFERENCES cat_sitters (cod_catsitter) on delete cascade on update cascade);