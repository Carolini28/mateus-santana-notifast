-- --------------------------------------------------------
-- Servidor:                     107.180.46.167
-- Versão do servidor:           5.6.30-cll-lve - MySQL Community Server (GPL)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura para tabela aguas.chamados
CREATE TABLE IF NOT EXISTS `chamados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_id` int(11) DEFAULT NULL,
  `servicos_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `descr_servico` varchar(255) NOT NULL,
  `atendente` varchar(255) NOT NULL,
  `resumo` varchar(255) NOT NULL,
  `data_encerramento` varchar(255) NOT NULL,
  `motivo_encerramento` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela aguas.chamados: 2 rows
/*!40000 ALTER TABLE `chamados` DISABLE KEYS */;
INSERT INTO `chamados` (`id`, `clientes_id`, `servicos_id`, `created`, `modified`, `descr_servico`, `atendente`, `resumo`, `data_encerramento`, `motivo_encerramento`, `ativo`) VALUES
	(1, 1, 2, '2016-12-04 01:36:36', '2016-12-04 01:36:38', 'CORTE NO CAVALETE', 'Thiago Gomes', 'em execução', '05-12-2016', '0-Executado', 1),
	(2, 2, 1, '2016-12-04 01:43:47', '2016-12-04 01:43:46', 'VAZAMENTO CAV.3/4', 'Lucas Barque', 'não iniciado', '06-12-2016', '0-Executado', 1);
/*!40000 ALTER TABLE `chamados` ENABLE KEYS */;


-- Copiando estrutura para tabela aguas.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(100) DEFAULT NULL,
  `numero_ligacao` varchar(100) DEFAULT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `celular` varchar(100) DEFAULT NULL,
  `telefone` varchar(100) DEFAULT NULL,
  `cadastrado` tinyint(4) DEFAULT '0',
  `info_debitos` tinyint(4) DEFAULT NULL,
  `info_sms` tinyint(4) DEFAULT NULL,
  `fb` tinyint(4) DEFAULT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela aguas.clientes: 2 rows
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `cpf`, `numero_ligacao`, `nome`, `email`, `celular`, `telefone`, `cadastrado`, `info_debitos`, `info_sms`, `fb`, `fb_id`) VALUES
	(1, '111.111.111-11', '11111111-1', 'Lucas Barque da Silva', 'lucasbarque@gestaoativa.com.br', '(67) 99999-9999', '(67) 3333-3333', 1, 1, 1, 0, '1169149353203923'),
	(2, '222.222.222-22', '22222222-2', 'Carolini Rodrigues', 'carolini@gmail.com', '(67) 99178-4175', '(22) 2200-00', 1, 1, 1, NULL, NULL),
	(3, '333.333.333-33', '33333333-3', 'Thiago Gomes', 'thiago.silvagom@gmail.com', '(67) 90000-0000', '(67) 3000-0000', 1, 1, 1, 0, '10211766483337480');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Copiando estrutura para tabela aguas.debitos
CREATE TABLE IF NOT EXISTS `debitos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clientes_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `valor` varchar(255) NOT NULL,
  `data_vencimento` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela aguas.debitos: 0 rows
/*!40000 ALTER TABLE `debitos` DISABLE KEYS */;
/*!40000 ALTER TABLE `debitos` ENABLE KEYS */;


-- Copiando estrutura para tabela aguas.evento_chamados
CREATE TABLE IF NOT EXISTS `evento_chamados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chamados_id` int(11) DEFAULT NULL,
  `sms` tinyint(4) DEFAULT '1',
  `data` datetime DEFAULT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela aguas.evento_chamados: 3 rows
/*!40000 ALTER TABLE `evento_chamados` DISABLE KEYS */;
INSERT INTO `evento_chamados` (`id`, `chamados_id`, `sms`, `data`, `descricao`, `status`) VALUES
	(1, 2, 1, '2016-12-04 02:37:21', 'Serviço encaminhado para análise', 'Realizado'),
	(2, 2, 1, '2016-12-02 02:38:13', 'Equipe técnica encaminhada para consertar o problema', 'Informação'),
	(3, 1, 1, '2016-12-04 02:39:28', 'Serviço encaminhado para análise', 'Realizado'),
	(4, 1, 1, '2016-12-04 09:18:11', ' Equipe técnica remanejada, houve um emprevisto em um hospital', 'Cancelado');
/*!40000 ALTER TABLE `evento_chamados` ENABLE KEYS */;


-- Copiando estrutura para tabela aguas.servicos
CREATE TABLE IF NOT EXISTS `servicos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `tempo_de_execucao` varchar(255) NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela aguas.servicos: 2 rows
/*!40000 ALTER TABLE `servicos` DISABLE KEYS */;
INSERT INTO `servicos` (`id`, `created`, `modified`, `titulo`, `tempo_de_execucao`, `ativo`) VALUES
	(1, '2016-12-04 01:29:03', '2016-12-04 01:29:06', 'Religacao de Água', '24', 1),
	(2, '2016-12-04 01:31:14', '2016-12-04 01:31:15', '2º Via de Conta', '1', 1);
/*!40000 ALTER TABLE `servicos` ENABLE KEYS */;


-- Copiando estrutura para tabela aguas.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) DEFAULT NULL,
  `key` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela aguas.usuarios: 2 rows
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id`, `titulo`, `key`) VALUES
	(1, 'GSS', '791ed12f12312f43d12e'),
	(2, 'SGS', '2f351672a1209840e3a1');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
