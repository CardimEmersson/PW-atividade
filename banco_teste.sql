
-- Banco de dados: `banco_teste`
CREATE DATABASE pw_atividade;
USE pw_atividade;

CREATE TABLE `usuario` (
	`Id_usuario` int primary key auto_increment,
	`Nome_usuario` varchar(20) not null,
	`Sobrenome_usuario` varchar(30) not null,
	`Sexo_usuario` char(1) not null,
    `Nascimento_usuario` date not null,
    `Email_usuario` varchar(100) not null,
    `Celular_usuario` varchar(15) not null,
    `Senha_usuario` varchar(500) not null
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `produto` (
	`Id_produto` int auto_increment primary key not null,
	`Nome_produto` varchar(100) not null,
    `Url_imagem` varchar(200) not null,
    `Preco_produto` decimal(8,2) not null,
    `Descricao_produto` varchar(200) not null,
    `Quantidade_produto` int not null
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

