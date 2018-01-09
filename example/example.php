<?php 

include '../src/Blockchain.php';

$blockchain = new Blockchain;


/* kitaları BlockChain'e block olarak ekliyoruz,
   böylelikle bu kitalar sifrenelecek.
*/
$blockchain->addBlock(file_get_contents('./istiklalmarsi/kita1.txt'));
$blockchain->addBlock(file_get_contents('./istiklalmarsi/kita2.txt'));

var_dump($blockchain->dump());

/*

cikti:
array(2) {
  [0]=>
  array(5) {
    ["block"]=>
    int(1)
    ["nonce"]=>
    int(5705)
    ["payload"]=>
    string(174) "Korkma, sonmez bu safaklarda yuzen al sancak;
Sonmeden yurdumun ustunde tuten en son ocak.
O benim milletimin yildizidir, parlayacak;
O benimdir, o benim milletimindir ancak."
    ["hash"]=>
    string(64) "00ae54af33f2d151ce375bba5fd7e4205e8248bf80c2a57f9c219f3c3de38901"
    ["prevHash"]=>
    string(64) "0000000000000000000000000000000000000000000000000000000000000000"
  }
  [1]=>
  array(5) {
    ["block"]=>
    int(2)
    ["nonce"]=>
    int(1831)
    ["payload"]=>
    string(184) "Catma, kurban olayim, cehrene ey nazli hilal!
Kahraman irkima bir gul... Ne bu siddet, bu celal?
Sana olmaz dokulen kanlarimiz sonra helal;
Hakkidir, Hakk'a tapan, milletimin istiklal."
    ["hash"]=>
    string(64) "00aae572509cdcbb25caa26430e210481ad45ad011e01dd9d76903f8d38335b3"
    ["prevHash"]=>
    string(64) "00ae54af33f2d151ce375bba5fd7e4205e8248bf80c2a57f9c219f3c3de38901"
  }
}

*/