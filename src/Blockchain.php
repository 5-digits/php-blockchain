<?php 

ini_set('max_execution_time', 0); 


class Blockchain{

    public $maxNonce = 1000000;
    public $blocks   = [];

    /**
      * Blockchain'in temel yapısı olan blockları ekler.
      * @param $payload | any , Saklanacak veri
      * @return void,
    */ 
    public function addBlock($payload){

        array_push($this->blocks,[
            'block'     => count($this->blocks)+1,
            'nonce'     => 0,
            'payload'   => $payload,
            'hash'      => null,
            'prevHash'  => null,
        ]);

    }
    /**
     * Blockchain her bir bloğa benzersiz bir Hash tanımlıyor.
     * Bu tanımlama ise belirli bir kurala dayalı.
     * Bu fonksiyon overwrite edilmekçe Hash'ın 00a ile başlanmasına bakılacak.
     * Bu kural ne kadar zor olursa o kadar zor çözüm yapılıyor
     * @param   $chipherString | string, SHA256 ile şifrelenmiş string
     * @return  boolen, eğer doğru hash ise true döndürür.
    */
    public function acceptanceRule($cipherString){

        if( substr($cipherString,0,3) == "00a" ){
            return true;
        }

        return false;

    }
    /**
     * Eğer tüm blocklar hazırsa zinciri kuran temel fonksiyon
     * @return array
     */
    public function dump(){

        $dump = [];

        $prevHash = "0000000000000000000000000000000000000000000000000000000000000000";

        foreach($this->blocks as $index => $block){

            $this->blocks[$index]['prevHash'] = $prevHash;

            for($i = 0 ; $i < $this->maxNonce;$i++){

                $createSHA256 = hash("SHA256",json_encode($this->blocks[$index]));

                if(!$this->acceptanceRule($createSHA256)){

                    $this->blocks[$index]['nonce'] += 1;

                }else{
                    $this->blocks[$index]['hash'] = $createSHA256;
                    $prevHash = $createSHA256;
                    break;
                }

            }

        }

        return $this->blocks;

    }

}