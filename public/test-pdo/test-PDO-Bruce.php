<?php 
    require_once("initPDO.php");
	
	//$urlapi = "https://pokeapi.co/api/v2/pokemon/"
	class Pokemon{
		private $name;
		private $url;
		private $sprite;
		private $weight;

		public function __construct($name,$url){
			$this->name = $name;
			$this->url = $url;
			
			$pokedata = loadJsonPoke($url);
			$this->sprite = $pokedata["sprites"]["front_default"];
			$this->weight = $pokedata["weight"];
		}

		public function get_name(){
			return $this->name;
		}
		public function get_url(){
			return $this->url;
		}
		public function get_weight(){
			return $this->weight;
		}
		public function get_sprite(){
			return $this->sprite;
		}
	}


	function sendRequest($url)
        {
             $ch = curl_init();

            $timeout = 5;

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $data = curl_exec($ch);

            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($http_code != 200) {
                // return http code and error message
                return json_encode([
                    'code'    => $http_code,
                    'message' => $data,
                ]);
            }
            return $data;
        }
	
	function loadJson($url){
		$data = sendRequest($url);
    	$pokemons = json_decode($data, true);
		$respokemons = $pokemons["results"];
		return $respokemons;	
	}

	function loadJsonPoke($url){
		$data = sendRequest($url);
    	$pokemons = json_decode($data, true);
		return $pokemons;	
	}

	function toPokemon($url){
		$pokemons = loadJson($url);
		$listpoke = array();
		foreach($pokemons as $pokemon) {
			//echo $pokemon["name"]."\n";
			//echo $pokemon["url"]."\n";
			$poke = new Pokemon($pokemon["name"],$pokemon["url"]);
			$listPoke[] = $poke;
		}
		return($listPoke);
	}

	function tohtml($url){
		$pokemons = toPokemon($url);
		$allPokemons = '<table><tr><td>Name</td><td>Weight</td><td>Sprite</td></tr>';
		foreach($pokemons as $pokemon) {
			$allPokemons .= '<tr><td>'.$pokemon->get_name().'</td><td>'.$pokemon->get_weight().'</td><td><img src="'.$pokemon->get_sprite().'" /></td></tr>';
		}
		$allPokemons .= "</table>";
		return($allPokemons);
	}
    
	
    

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<style>
		table {
			border-top: 1px solid black;
			border-bottom: 1px solid black;
		}

		td {
			text-align: center;
			padding-left: 2em;
			padding-right: 2em;
		}
		</style>
	</head>
	<body>
	<h1>Pokemons</h1>
		<?php
			echo tohtml("https://pokeapi.co/api/v2/pokemon/"); //$allPokemon = Pokemon::showAllPokemon(RESTCALL())
			//file_get_content($url) 
			//json dcode -> en tableau
			//conversion en objet pokemon
			//fonction de pokemon pour afficher
		?>
	</body>
</html>
