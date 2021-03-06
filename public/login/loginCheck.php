<?php
require_once __DIR__."/../env.php";

if(!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])){
	$uri = 'https://';
	$ssl = true;
}else{
	$uri = 'http://';
	$ssl = false;
}

if(!$ssl && (!isset($_ENV["FORCE_ALLOW_HTTP"]) || $_ENV["FORCE_ALLOW_HTTP"] !== true)){
	fail();
}

if(defined("ALLOW_KEY_AUTHENTICATION") && ALLOW_KEY_AUTHENTICATION === true){
	require_once __DIR__."/../DatabaseConnection.php";
	if(isset($_GET['key']) && is_string($_GET['key'])){
		$keys = DatabaseConnection::getInstance()->query("SELECT key FROM authKeys");
		foreach($keys as $key){
			if(hash_equals($key["key"], $_GET['key'])){
				return;
			}
		}
	}
}

ini_set("session.gc_maxlifetime", 7*24*60*60);
ini_set("session.cookie_lifetime", 7*24*60*60);
if(!session_start()){
	fail();
}

$loggedIn = false;

if(!isset($_COOKIE['PHPSESSID']) || empty($_COOKIE['PHPSESSID'])){
	fail();
}

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){
	$loggedIn = true;
}

if(!$loggedIn){
	fail();
}

function fail(){
	global $uri;
	?>
	<script>
		window.location.replace("<?php echo(
			$uri.$_SERVER['HTTP_HOST'].
			substr(__DIR__, strlen($_SERVER['DOCUMENT_ROOT'])).
			'/login.php?destination='.$uri.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']
			);?>");
	</script>
	<?php
	exit;
}