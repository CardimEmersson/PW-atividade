
-- Banco de dados: `banco_teste`
CREATE DATABASE pw_atividade;
USE pw_atividade;

CREATE TABLE `usuario` (
	`Id` int primary key auto_increment,
	`Nome` varchar(20) not null,
	`Sobrenome` varchar(30) not null,
	`Sexo` char(1) not null,
    `Nascimento` date not null,
    `Email` varchar(100) not null,
    `Celular` varchar(15) not null,
    `Senha` varchar(500) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `produto` (
	`Id_produto` int auto_increment primary key not null,
	`Nome_produto` varchar(100) not null,
    `Url_imagem` varchar(200) not null,
    `Preco_produto` decimal(8,2) not null,
    `Descricao_produto` varchar(200) not null,
    `Quantidade` int not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `categoria` (
	`Id_categoria` int auto_increment primary key not null,
	`Nome_categoria` varchar(100) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `produto_categoria` (
	`Id_produto_categoria` int not null auto_increment primary key,
	`Fk_produto` int not null,
	`Fk_categoria` int not null,
    constraint `fk_produto` foreign key(`Fk_produto`) references produto(`Id_produto`),
	constraint `fk_categoria` foreign key(`Fk_categoria`) references categoria(`Id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

