<?php
/*
	Funções para CRUD.
*/

date_default_timezone_set("Etc/GMT+3"); 
//header("Content-type: text/html; charset=utf-8");
//echo "<pre>" . date('d/m/Y - H:i:s') . "<hr style='border-top:1px;'>";

function conexao( $db = null){
    $db_host = $db['host'] ?? '127.0.0.1';
    $db_user = $db['user'] ?? 'root';
    $db_pass = $db['pass'] ?? null;
    $db_name = $db['database'];
    try 
    {
        $conexao = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conexao;
    }
    catch (PDOException $e) {
        exit ("Falha na conexão : " . $e->getMessage());
    }
}

$conexao = conexao(['database'=>'banco']);
$table  = 'agenda';
//A chave é o campo na tabela.
$fields = [
	'nome'=>'teste',
];
$id = 5;


function select($conexao,$query){
		$res = $conexao->query($query);
		if ($res->rowCount() > 0){ 
			return $res->fetchAll();			
		}else{
			echo 'Sem resultados';
		}
}
$query = 'select * from agenda ';
//print_r ( select($conexao,$query) );

function delete($conexao,$table,$id){
	try {
		$stmt = $conexao->prepare('DELETE FROM ' . $table . ' WHERE id = :id');
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		echo $stmt->rowCount();}
	catch (PDOException $e) {
        exit ("Falha na conexão : " . $e->getMessage());
    }
}
//print_r (delete($conexao,['table'=>'agenda','id'=>'4'])); 

function update($conexao,$table,$fields, $id){
	try {
		$campos = '';
		foreach ($fields as $k => $v){
		    $campos .= $k . " = :" . $k . ' , ';
		}
		$campos = substr($campos,0,-2);
		$sql  = "UPDATE $table  SET  $campos WHERE id = $id ";
		$stmt = $conexao->prepare($sql);
		$stmt->execute($fields);
		echo $stmt->rowCount();
	}
	catch (PDOException $e) {
        exit ("Falha na conexão : " . $e->getMessage());
    }
}
//print_r(update($conexao,$table,$fields,"5"));

function insert($conexao,$table,$fields){
	try {
		$valores = '';
		$campos  = '';
		foreach ($fields as $k => $v){
		    $valores .= ":" . $k . ', ';
		    $campos  .= $k . ', ';
		}
		$campos = substr($campos,0,-2);
		$valores = substr($valores,0,-2);
		$sql = 'INSERT INTO ' . $table . ' ( ' . $campos . ' ) VALUES ( ' . $valores . ' );';
		$stmt= $conexao->prepare($sql);
		$stmt->execute($fields);
		echo $stmt->rowCount();
	}catch (PDOException $e) {
	    exit ("Falha na conexão : " . $e->getMessage());
	}
}
//print_r(insert($conexao,'agenda',$fields));







