
-- Banco de dados: `banco_teste`

CREATE TABLE `cadastro` (
  `NomeCliente` varchar(20) DEFAULT NULL,
  `SobrenomeCliente` varchar(30) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL,
  `ID` int primary key auto_increment


) ENGINE=InnoDB DEFAULT CHARSET=latin1;


INSERT INTO `cadastro` (`NomeCliente`, `SobrenomeCliente`, `Sexo`) VALUES
('Fábio', 'dos Reis', 'M', 'C'),
('Ana', 'de Souza', 'F'),
('Ana Maria', 'Moraes', 'F'),
('Jonas', 'Batista', 'M'),
('Augusto', 'Gomes', 'M'),
('Maria', 'da Silva', 'F');
