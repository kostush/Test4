<?php
class Api extends Model {

    public $token;
    public $random;
    public $transaction_id;

    public function auth($login,$pass){
        $this->token = md5($login.$pass.time());
        $db = new SafeMySQL();

        $result = $db->query(
            'INSERT INTO api_auth (`LOGIN`,`PASS`,`TOKEN`) VALUES(?s,?s,?s)'.
            'ON DUPLICATE KEY UPDATE `TOKEN` = ?s',
            $login,$pass,$this->token,$this->token
        );
        return $result;

    }

   public function check_auth($request_token){
        $db = new SafeMySQL();
        $result = $db->getOne(
            'SELECT * FROM api_auth 
                  WHERE `TOKEN` = ?s AND `LASTUPDATE` >  (DATE_SUB(NOW(), INTERVAL 60 second))  ',$request_token);

        return $result;
    }


    public function generate(){
        $this->random = rand(1,100000);
        $this->transaction_id = md5($this->random.time());
        echo $this->transaction_id;
        $db = new SafeMySQL();
        $result = $db->query(
            'INSERT INTO api_random (`TRANSACTION_ID`,`RANDOM`) VALUES (?s,?i)',$this->transaction_id,$this->random);

        return $result;

    }
    public function retrieve($id){

        $db = new SafeMySQL();
        $result = $db->getRow(
            'SELECT * FROM api_random WHERE `TRANSACTION_ID`= ?s',$id
        );
        return $result;
    }

}
?>




