<?php


/** CONFIG:START **/
$config["host"] 		= "localhost" ; 		//host
$config["user"] 		= "root" ; 		//Username SQL
$config["pass"] 		= "" ; 		//Password SQL
$config["dbase"] 		= "db_remedios_naturais" ; 		//Database
$config["utf8"] 		= true ; 		//turkish charset set false
$config["abs_url_images"] 		= "http://anaski.net/apps/remedios_naturais//media/image/" ; 		//Absolute Images URL
$config["abs_url_videos"] 		= "http://anaski.net/apps/remedios_naturais//media/media/" ; 		//Absolute Videos URL
$config["abs_url_audios"] 		= "http://anaski.net/apps/remedios_naturais//media/media/" ; 		//Absolute Audio URL
$config["abs_url_files"] 		= "http://anaski.net/apps/remedios_naturais//media/file/" ; 		//Absolute Files URL
$config["image_allowed"][] 		= array("mimetype"=>"image/jpeg","ext"=>"jpg") ; 		//whitelist image
$config["image_allowed"][] 		= array("mimetype"=>"image/jpg","ext"=>"jpg") ; 		
$config["image_allowed"][] 		= array("mimetype"=>"image/png","ext"=>"png") ; 		
$config["file_allowed"][] 		= array("mimetype"=>"text/plain","ext"=>"txt") ; 		
/** CONFIG:END **/

if(isset($_SERVER["HTTP_X_AUTHORIZATION"])){
	list($_SERVER["PHP_AUTH_USER"],$_SERVER["PHP_AUTH_PW"]) = explode(":" , base64_decode(substr($_SERVER["HTTP_X_AUTHORIZATION"],6)));
}
$rest_api=array("data"=>array("status"=>404,"title"=>"Not found"),"title"=>"Error","message"=>"Routes not found");

/** connect to mysql **/
$mysql = new mysqli($config["host"], $config["user"], $config["pass"], $config["dbase"]);
if (mysqli_connect_errno()){
	die(mysqli_connect_error());
}


if(!isset($_GET["json"])){
	$_GET["json"]= "route";
}
if((!isset($_GET["form"])) && ($_GET["json"] == "submit")) {
	$_GET["json"]= "route";
}

if($config["utf8"]==true){
	$mysql->set_charset("utf8");
}

$get_dir = explode("/", $_SERVER["PHP_SELF"]);
unset($get_dir[count($get_dir)-1]);
$main_url = "http://" . $_SERVER["HTTP_HOST"] . implode("/",$get_dir)."/";


switch($_GET["json"]){	
	// TODO: -+- Listing : categorias
	case "categorias":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` LIKE '%".$mysql->escape_string($_GET["id"])."%'";
			}
		}
		if(isset($_GET["titulo"])){
			if($_GET["titulo"]!="-1"){
				$_where[] = "`titulo` LIKE '%".$mysql->escape_string($_GET["titulo"])."%'";
			}
		}
		if(isset($_GET["imagem"])){
			if($_GET["imagem"]!="-1"){
				$_where[] = "`imagem` LIKE '%".$mysql->escape_string($_GET["imagem"])."%'";
			}
		}
		if(isset($_GET["descricao"])){
			if($_GET["descricao"]!="-1"){
				$_where[] = "`descricao` LIKE '%".$mysql->escape_string($_GET["descricao"])."%'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="titulo"){
			$order_by = "`titulo`";
		}
		if($_GET["order"]=="imagem"){
			$order_by = "`imagem`";
		}
		if($_GET["order"]=="descricao"){
			$order_by = "`descricao`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `categorias` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, 100" ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['titulo'])){$rest_api[$z]['titulo'] = $data['titulo'];}; # heading-1
				
				$abs_url_images = $config['abs_url_images'].'/';
				$abs_url_videos = $config['abs_url_videos'].'/';
				$abs_url_audios = $config['abs_url_audios'].'/';
				if(!isset($data['imagem'])){$data['imagem']='undefined';}; # images
				if((substr($data['imagem'], 0, 7)=='http://')||(substr($data['imagem'], 0, 8)=='https://')){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if(substr($data['imagem'], 0, 5)=='data:'){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				$rest_api[$z]['imagem'] = $abs_url_images . $data['imagem']; # images
				if(isset($data['descricao'])){$rest_api[$z]['descricao'] = $data['descricao'];}; # paragraph
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}
			}
		}

		break;
	
	// TODO: -+- Listing : remedios
	case "remedios":
		$rest_api=array();
		$where = $_where = null;
		// TODO: -+----+- statement where
		if(isset($_GET["id"])){
			if($_GET["id"]!="-1"){
				$_where[] = "`id` LIKE '%".$mysql->escape_string($_GET["id"])."%'";
			}
		}
		if(isset($_GET["titulo"])){
			if($_GET["titulo"]!="-1"){
				$_where[] = "`titulo` LIKE '%".$mysql->escape_string($_GET["titulo"])."%'";
			}
		}
		if(isset($_GET["texto"])){
			if($_GET["texto"]!="-1"){
				$_where[] = "`texto` LIKE '%".$mysql->escape_string($_GET["texto"])."%'";
			}
		}
		if(isset($_GET["imagem"])){
			if($_GET["imagem"]!="-1"){
				$_where[] = "`imagem` LIKE '%".$mysql->escape_string($_GET["imagem"])."%'";
			}
		}
		if(isset($_GET["categorias"])){
			if($_GET["categorias"]!="-1"){
				$_where[] = "`categorias` LIKE '%".$mysql->escape_string($_GET["categorias"])."%'";
			}
		}
		if(isset($_GET["contribuidor"])){
			if($_GET["contribuidor"]!="-1"){
				$_where[] = "`contribuidor` LIKE '%".$mysql->escape_string($_GET["contribuidor"])."%'";
			}
		}
		if(isset($_GET["resumo"])){
			if($_GET["resumo"]!="-1"){
				$_where[] = "`resumo` LIKE '%".$mysql->escape_string($_GET["resumo"])."%'";
			}
		}
		if(is_array($_where)){
			$where = " WHERE " . implode(" AND ",$_where);
		}
		// TODO: -+----+- orderby
		$order_by = "`id`";
		$sort_by = "DESC";
		if(!isset($_GET["order"])){
			$_GET["order"] = "`id`";
		}
		// TODO: -+----+- sort asc/desc
		if(!isset($_GET["sort"])){
			$_GET["sort"] = "desc";
		}
		if($_GET["sort"]=="asc"){
			$sort_by = "ASC";
		}else{
			$sort_by = "DESC";
		}
		if($_GET["order"]=="id"){
			$order_by = "`id`";
		}
		if($_GET["order"]=="titulo"){
			$order_by = "`titulo`";
		}
		if($_GET["order"]=="texto"){
			$order_by = "`texto`";
		}
		if($_GET["order"]=="imagem"){
			$order_by = "`imagem`";
		}
		if($_GET["order"]=="categorias"){
			$order_by = "`categorias`";
		}
		if($_GET["order"]=="contribuidor"){
			$order_by = "`contribuidor`";
		}
		if($_GET["order"]=="resumo"){
			$order_by = "`resumo`";
		}
		if($_GET["order"]=="random"){
			$order_by = "RAND()";
		}
		// TODO: -+----+- SQL Query
		$sql = "SELECT * FROM `remedios` ".$where."ORDER BY ".$order_by." ".$sort_by." LIMIT 0, 100" ;
		if($result = $mysql->query($sql)){
			$z=0;
			while ($data = $result->fetch_array()){
				if(isset($data['id'])){$rest_api[$z]['id'] = $data['id'];}; # id
				if(isset($data['titulo'])){$rest_api[$z]['titulo'] = $data['titulo'];}; # heading-1
				if(isset($data['texto'])){$rest_api[$z]['texto'] = $data['texto'];}; # to_trusted
				
				$abs_url_images = $config['abs_url_images'].'/';
				$abs_url_videos = $config['abs_url_videos'].'/';
				$abs_url_audios = $config['abs_url_audios'].'/';
				if(!isset($data['imagem'])){$data['imagem']='undefined';}; # images
				if((substr($data['imagem'], 0, 7)=='http://')||(substr($data['imagem'], 0, 8)=='https://')){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				
				if(substr($data['imagem'], 0, 5)=='data:'){
					$abs_url_images = $abs_url_videos  = $abs_url_audios = '';
				}
				$rest_api[$z]['imagem'] = $abs_url_images . $data['imagem']; # images
				if(isset($data['categorias'])){$rest_api[$z]['categorias'] = $data['categorias'];}; # text
				if(isset($data['contribuidor'])){$rest_api[$z]['contribuidor'] = $data['contribuidor'];}; # webview
				if(isset($data['resumo'])){$rest_api[$z]['resumo'] = $data['resumo'];}; # text
				$z++;
			}
			$result->close();
			if(isset($_GET["id"])){
				if(isset($rest_api[0])){
					$rest_api = $rest_api[0];
				}
			}
		}

		break;
	// TODO: -+- route
	case "route":		$rest_api=array();
		$rest_api["site"]["name"] = "Remedios Naturais" ;
		$rest_api["site"]["description"] = "Cura pela natureza" ;
		$rest_api["site"]["version"] = "rev17.07.01" ;

		$rest_api["routes"][0]["namespace"] = "categorias";
		$rest_api["routes"][0]["tb_version"] = "Upd.1712200716";
		$rest_api["routes"][0]["methods"][] = "GET";
		$rest_api["routes"][0]["args"]["id"] = array("required"=>"false","description"=>"Selecting `categorias` based `id`");
		$rest_api["routes"][0]["args"]["titulo"] = array("required"=>"false","description"=>"Selecting `categorias` based `titulo`");
		$rest_api["routes"][0]["args"]["imagem"] = array("required"=>"false","description"=>"Selecting `categorias` based `imagem`");
		$rest_api["routes"][0]["args"]["descricao"] = array("required"=>"false","description"=>"Selecting `categorias` based `descricao`");
		$rest_api["routes"][0]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `titulo`, `imagem`, `descricao`");
		$rest_api["routes"][0]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][0]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=categorias";
		$rest_api["routes"][1]["namespace"] = "remedios";
		$rest_api["routes"][1]["tb_version"] = "Upd.1712200749";
		$rest_api["routes"][1]["methods"][] = "GET";
		$rest_api["routes"][1]["args"]["id"] = array("required"=>"false","description"=>"Selecting `remedios` based `id`");
		$rest_api["routes"][1]["args"]["titulo"] = array("required"=>"false","description"=>"Selecting `remedios` based `titulo`");
		$rest_api["routes"][1]["args"]["texto"] = array("required"=>"false","description"=>"Selecting `remedios` based `texto`");
		$rest_api["routes"][1]["args"]["imagem"] = array("required"=>"false","description"=>"Selecting `remedios` based `imagem`");
		$rest_api["routes"][1]["args"]["categorias"] = array("required"=>"false","description"=>"Selecting `remedios` based `categorias`");
		$rest_api["routes"][1]["args"]["contribuidor"] = array("required"=>"false","description"=>"Selecting `remedios` based `contribuidor`");
		$rest_api["routes"][1]["args"]["resumo"] = array("required"=>"false","description"=>"Selecting `remedios` based `resumo`");
		$rest_api["routes"][1]["args"]["order"] = array("required"=>"false","description"=>"order by `random`, `id`, `titulo`, `texto`, `imagem`, `categorias`, `contribuidor`, `resumo`");
		$rest_api["routes"][1]["args"]["sort"] = array("required"=>"false","description"=>"sort by `asc` or `desc`");
		$rest_api["routes"][1]["_links"]["self"] = "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["PHP_SELF"]."?json=remedios";
		break;
	// TODO: -+- submit

	case "submit":
		$rest_api=array();

		$rest_api["methods"][0] = "POST";
		$rest_api["methods"][1] = "GET";

	break;

}


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,PATCH,OPTIONS');
header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization,X-Authorization');
if (!isset($_GET["callback"])){
	header('Content-type: application/json');
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo json_encode($rest_api,JSON_UNESCAPED_UNICODE);
	}else{
		echo json_encode($rest_api);
	}

}else{
	if(defined("JSON_UNESCAPED_UNICODE")){
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api,JSON_UNESCAPED_UNICODE). ");" ;
	}else{
		echo strip_tags($_GET["callback"]) ."(". json_encode($rest_api) . ");" ;
	}

}