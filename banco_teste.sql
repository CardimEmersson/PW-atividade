
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

