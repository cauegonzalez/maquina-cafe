# maquina-cafe
Repositório para a criação de um CRUD em PHP OO

Considerações iniciais:
**Versão do PHP**: 7.2.8
**Endereço inicial**: maquina-cafe/public
**Necessário executar**: composer update
**Arquivo com os dados de acesso ao banco de dados**: maquina-cafe/config.php
**Script para criação e alimentação prévia do banco de dados**:


```
CREATE TABLE `cargo` (
  `idcargo` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `permissao_especial` enum('S','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`idcargo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
```
CREATE TABLE `funcionario` (
  `idfuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `cargo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`idfuncionario`),
  KEY `fk_cargo_idx` (`cargo_id`),
  CONSTRAINT `fk_cargo` FOREIGN KEY (`cargo_id`) REFERENCES `cargo` (`idcargo`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
```
CREATE TABLE `tipo_cafe` (
  `idtipo_cafe` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) NOT NULL,
  `exige_permissao_especial` enum('S','N') NOT NULL DEFAULT 'S',
  PRIMARY KEY (`idtipo_cafe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
```
CREATE TABLE `historico_cafe` (
  `idhistorico_cafe` int(11) NOT NULL AUTO_INCREMENT,
  `funcionario_id` int(11) NOT NULL,
  `tipo_cafe_id` int(11) NOT NULL,
  `data_hora` datetime NOT NULL,
  PRIMARY KEY (`idhistorico_cafe`),
  KEY `fk_funcionario_idx` (`funcionario_id`),
  KEY `fk_tipo_cafe_idx` (`tipo_cafe_id`),
  CONSTRAINT `fk_funcionario` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionario` (`idfuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tipo_cafe` FOREIGN KEY (`tipo_cafe_id`) REFERENCES `tipo_cafe` (`idtipo_cafe`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
```
INSERT INTO `tipo_cafe`
(`nome`, `exige_permissao_especial`)
VALUES
('Café Normal', 'N'),
('Café Pingado', 'S'),
('Cappuccino', 'S'),
('Mochaccino', 'S');
```
```
INSERT INTO `cargo`
(`nome`, `permissao_especial`)
VALUES
('Gerente', 'S'),
('Diretor', 'S'),
('Analista de Sistemas', 'S'),
('Desenvolvedor', 'N'),
('Web Designer', 'N');
('Estagiário', 'N'),
('Recepcionista', 'N'),
```
