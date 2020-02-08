<?php
// /date_default_timezone_set('America/Sao_Paulo');
date_default_timezone_set("Etc/GMT+3"); 
header("Content-type: text/html; charset=utf-8");

function foldersize($dir){
     $count_size = 0;
     $count = 0;
     $dir_array = scandir($dir);
     foreach($dir_array as $key=>$filename){
      if($filename!=".." && $filename!="."){
       if(is_dir($dir."/".$filename)){
        $new_foldersize = foldersize($dir."/".$filename);
        $count_size = $count_size + $new_foldersize;
       }else if(is_file($dir."/".$filename)){
        $count_size = $count_size + filesize($dir."/".$filename);
        $count++;
       }
      }

     }

     return $count_size;
	//$dir = 'pasta'; // Retorna o tamanho da pasta em bytes.
	//echo foldersize($dir);	
}

function ConverterPrefixoBinario ($Valor, $UnidadeOrigem, $UnidadeDestino, $Precisão = 2) {
    $Unidades = array (
        'B' => 1, 
        'KB' => 1000, 'MB' => 1000000, 'GB' => 1000000000, 'TB' => 1000000000,
        'KiB' => 1024, 'MiB' => 1048576, 'GiB' => 1073741824, 'TiB' => 1099511627776
    );

    $ValorBytes = $Valor * $Unidades [$UnidadeOrigem];

    return round($ValorBytes / $Unidades [$UnidadeDestino], $Precisão) . $UnidadeDestino;
//echo ConverterPrefixoBinario (1572864, 'B', 'MiB');
}

function delTree($dir) { 
    $files = array_diff(scandir($dir), array('.','..')); 
    foreach ($files as $file) { 
      (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
    } 
    return rmdir($dir); 
  }

function debug(){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
}

function dd($a = null, $b = null){
    if ($a == null){
          echo "<hr><h3><samp><center>Faltou variável para depurar</center></samp></h3><hr>";
          exit;
    }
        echo "<pre><hr style='border-bottom: 1px solid #282828;'>";
        echo 'Requisição : <b>' . $_SERVER['REQUEST_METHOD'] . "</b>".PHP_EOL;
        print_r($a);
         echo "</pre><hr style='border-bottom: 1px solid #282828;'>";
    if ($b != null) { 
        echo "<center><b><pre style='color:red'>" . date('d/m/Y - H:i:s') . "</pre></b></center>" ;
        exit(); 
    } 
}

function inicio( $title = null){
    $html = '<!DOCTYPE html>
              <html lang="pt-br">
              <head>
                <meta charset="utf-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <title>' . $title['title'].' </title>
                <link rel="shortcut icon" href="data:image/x-icon;base64,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AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA////////AAD///////8AAP///////wAA////////AAD///////8AAP///////wAA////////AAD///////8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD/AAAAAP8AAP8AAAAA/wAA/wAAAAD/AAD///////8AAP///////wAA////////AAD///////8AAP///////wAA////////AAD///////8AAP///////wAA" />
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" >
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.12/css/bootstrap-select.min.css">
                <style>
                .sidenav {
                  height: 100%;
                  width: 200px;
                  position: fixed;
                  z-index: 1;
                  top: 0;
                  left: 0;
                  background-color: #343A40;
                  overflow-x: hidden;
                  padding-top: 20px;
                }
                
                #main {
                  margin-left: 200px; /* Same as the width of the sidenav */
                }

                /* The navigation menu links */
                .sidenav a {
                  padding: 8px 8px 8px 32px;
                  text-decoration: none;
                  font-size: 12px;
                  color: #818181;
                  display: block;
                  transition: 0.3s;
                }
                
                .sidenav a:hover {
                  color: #f1f1f1;
                }
                
                #main {
                  transition: margin-left .5s;
                  padding: 20px;
                }
                
                /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
                @media screen and (max-height: 450px) {
                  .sidenav {padding-top: 15px;}
                  .sidenav a {font-size: 18px;}
                } 

                .input{
                  border:0px; 
                  width:100%;
                }
                </style>
                </head>
              <body>';
    echo $html;
}


function navbar($titulo = 'Titulo',$link = '#'){
    $retorno = '<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
            <a class="nav-link" href="'.$link.'">'.$titulo.'</a>
        </li>
    </ul></div></nav>';
   echo $retorno;
}

function menu($titulo,$menu){
 
 $retorno ='<div class="sidenav">';
  $retorno .='<div class="text-center text-white">'.$titulo.'</div>';
  foreach($menu as $link => $title){
    $retorno .= '<a href="'.$link.'">'.$title.'</a>';
  }
  $retorno .= '</div>';
  echo $retorno;
}

function main($a = null){
  if ($a == '1'){
    $retorno = '<div id="main">';
  }else{
    $retorno = '</div> ';
  }
  echo $retorno;
}

function linha($linha = 'inicio'){
    if ($linha == 'inicio'){
        echo "<div class='row'>";
    }else{
        echo "</div>";
    }

}

function js(){
   $html = '
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/esm/popper.min.js" ></script>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js" ></script>
              <script src="http://www.openjs.com/scripts/events/keyboard_shortcuts/shortcut.js"></script>
              '; 
    echo $html;
}

function fim($footer = null){
    $retorno = '<footer style="position: fixed; left: 0; bottom: 0; width: 100%; background-color: #343A40; color: white; text-align: center;">
    <div class="container text-center">
      <span class="text-muted">'.$footer.'</span>
    </div>
    </footer>
    </body>
    </html>';

    echo $retorno;
}

/*
    Funcao para conexao ao banco de dados
*/
function conexao( $db ){
    $db_host = $db[0];
    $db_user = $db[1];
    $db_pass = $db[2];
    $db_name = $db[3];
    try 
    {
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    Catch (PDOException $erro)
    {
        exit ("Falha na conexão : " . $erro->getMessage());
    }
}

// Monta elementos de HTML com Bootstrap

function input($input = null){
  isset($input['col'])   ? $input['col']   : $input['col']   = '12'; 
  isset($input['name'])  ? $input['name']  : $input['name']  = 'input'; 
  isset($input['title']) ? $input['title'] : $input['title'] = 'Titulo'; 
  isset($input['type'])  ? $input['type']  : $input['type']  = 'text'; 
  echo "
	<div class='form-group col-".$input['col']."'>
		<label for='".$input['name']."'>".$input['title']."</label>
		<input type='".$input['type']."' class='form-control' id='".$input['name']."' name='".$input['name']."'>
	</div>";
}

function hidden($hidden){
    isset($hidden['name'])  ? $hidden['name']  : $hidden['name']  = 'enviar';
    isset($hidden['value']) ? $hidden['value'] : $hidden['value'] = null;
    echo "<input type='hidden' name='".$hidden['name']."' id='".$hidden['name']."' value='".$hidden['value']."' />";
}

function button($button= null){
    isset($button['name'])        ? $button['name']        : $button['name']        = 'enviar';
    isset($button['class'])       ? $button['class']       : $button['class']       = 'btn btn-outline-primary';
    isset($button['title'])       ? $button['title']       : $button['title']       = 'Botão';
    isset($button['placeholder']) ? $button['placeholder'] : $button['placeholder'] = 'Botão';

    echo "<div class='form-group ' style='padding:14px;'>
            <button type='submit'  title='".$button['placeholder']."' id='".$button['name']. "' class='" . $button['class'] . " '>".$button['title']."</button>
            </div>";
}

function select( $select = null, $options = ['H'=>'Homem','F'=>"Feminino"]){
    isset($select['col'])   ? $select['col']   : $select['col']   = '12';
    isset($select['class']) ? $select['class'] : $select['class'] = '';
    isset($select['name'])  ? $select['name']  : $select['name']  = '_';
    isset($select['title']) ? $select['title'] : $select['title'] = '&nbsp;';
    $retorno = "
		<div class='form-group col-".$select['col']."'>
		<label for='". $select['name'] ."'>".$select['title']."</label>
        <select class='form-control ".$select['class']."' id='". $select['name'] ."' name='". $select['name'] ."' >
        <option value='' selected disabled>Selecionar</option>";
    foreach($options as $k=>$v){
        $retorno .= '<option value='.$k. '>'.$v.'</option>';
    }
    $retorno .= "     
		</select>
      </div>";
    echo $retorno;
}

function alert( $alert = null){
    isset($alert['name'])  ? $alert['name']  : $alert['name']  = null;
    isset($alert['type'])  ? $alert['type']  : $alert['type']  = 'danger';
    isset($alert['title']) ? $alert['title'] : $alert['title'] = '';
    isset($alert['msg'])   ? $alert['msg']   : $alert['msg']   = '';
    isset($alert['x'])     ? $alert['x']     : $alert['x']     = false;

    $retorno = "<div id='".$alert['name']."'  class='alert alert-".$alert['type']." alert-dismissible fade show' role='alert'>
            <strong>".$alert['title']." </strong>".$alert['msg']." ";
    if ($alert['x']){
        $retorno .= "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    }
    $retorno .= "<span aria-hidden='true'>&times;</span>
            </button>
        </div>";

    echo $retorno;
}

function loading($class = 'danger' ){
    echo '<div class="spinner-border text-'.$class.'"></div>';
}

function hr(){
    echo "<hr style='border-bottom: 1px solid #282828;'>";
}

function hora(){
    echo date('H:i:s');
}

function data(){
    echo date('d/m/Y');
}

function jumbotron($jumbo){
    isset($jumbo['col'])   ? $jumbo['col']   : $jumbo['col']   = '12';
    isset($jumbo['title']) ? $jumbo['title'] : $jumbo['title'] = 'Titulo';
    isset($jumbo['msg'])   ? $jumbo['msg']   : $jumbo['msg']   = 'Msg';
    isset($jumbo['type'])  ? $jumbo['type']  : $jumbo['type']  = 'muted';
    isset($jumbo['color']) ? $jumbo['color'] : $jumbo['color'] = 'dark';
    $retorno = '
        <div class="jumbotron bg-'.$jumbo['type'].' text-'.$jumbo['color'].' text-center col-'.$jumbo['col'].'" style="margin-bottom:0">
            <h1>'.$jumbo['title'].'</h1>
            <p>'.$jumbo['msg'].'</p> 
        </div>'. PHP_EOL;;
    echo $retorno;
}

function buttongroup($btn = null){
    $retorno = '
      <div class="btn-group" role="group" style="padding:14px;">'. PHP_EOL;
      foreach($btn as $k=>$v){
        $retorno .= '<button type="button" id="'.$v['name'].'" title="'.$v['placeholder'].'" class="'.$v['class'].'">'.$v['title'].'</button>'. PHP_EOL;
      }
      $retorno .= '</div>';

      echo $retorno;
}

