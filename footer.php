<?php
require_once('initialize.php');
use GuzzleHttp\Client;
use GuzzleHttp\Get;
$client = new Client(['base_uri' => 'https://binaryjazz.us/wp-json/genrenator/v1/genre/']);
$response = $client->get('1');
$music = "";
if(!is_null($response)){
    $music = $response->getBody('');
}
?>



<footer>
    <p>Starting a band and not sure what kind of music to play? Try <?php echo $music;?>!</p>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
