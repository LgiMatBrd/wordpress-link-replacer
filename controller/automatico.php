<?php
/*************************************************/
/*
/* WORDPRESS LINK REPLACER
/*
/* Autor: Luigi Matheus Afornalli Breda
/*
/*************************************************/

$AJAX = array();
parse_str($_POST['ajax'], $AJAX);

/**************************************/
/* SALVA ALGUMAS VARIAVEIS QUE VAMOS ULTILIZAR
/**************************************/
date_default_timezone_set('America/Sao_Paulo');
$query = $AJAX['query'];
$host = $AJAX['host'];
$user = $AJAX['user'];
$senha = $AJAX['senha'];
$nome_banco = $AJAX['nome_banco'];

/**************************************/
/* CONECTA AO BANCO DE DADOS
/**************************************/
$mysql_hostname = $host;
$mysql_user = $user;
$mysql_password = $senha;
$mysql_database = $nome_banco;
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die("Não foi possível se conectar ao banco de dados");
mysql_select_db($mysql_database, $bd) or die("Não foi possível definir a tabela do banco de dados");

/**************************************/
/* EXECUTA AS AÇÕES ENVIADAS PELO AJAX
/**************************************/
if ($AJAX['acao'] == 'automatico') {
	// EXECUTA A QUERY
	$resultado = mysql_query($query);
	
	// VERIFICA O RESULTADO E ENVIA A RESPOSTA
	if($resultado)
	{
		print_r($_GET['callback'].'('.json_encode(array('ok' => 'Links trocados com sucesso.'), JSON_UNESCAPED_UNICODE).');');
	}
	else
	{
		print_r($_GET['callback'].'('.json_encode(array('erro' => 'Erro ao executar a query, verifique os dados informados.'), JSON_UNESCAPED_UNICODE).');');
	}
} else {
	print_r($_GET['callback'].'('.json_encode(array('erro' => 'Erro interno, contate o desenvolvedor. COD: 001'), JSON_UNESCAPED_UNICODE).');');
}