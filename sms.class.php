<?php
/**
 * Created by PhpStorm.
 * User: lenovo G50-80
 * Date: 4/28/2018
 * Time: 10:03 PM
 */

defined('MOODLE_INTERNAL') || die();

class SMS
{
    private $username;
    private $password;
    private $sender;
    function __construct()
    {
        $this->username = "6EFYWHZY";
        $this->password = "2VZHY5";
        $this->sender = "Koalasys";
    }
    public function send($message,$mobile){
        $mobile = $this->fixMobileCountryCode($mobile);
        $this->validateMobileNumber($mobile);
        $message = $this->handleMessage($message);
        $url = "https://www.smsmisr.com/api/send/?username=".$this->username."&password=".$this->password."&language=3&sender=".$this->sender."&mobile=".$mobile."&message=".$message;
        return file_get_contents($url);
    }
    public function fixMobileCountryCode($mobile){
        if($mobile[0] != 2)
        {
            return "2".(string) $mobile;
        }
        return $mobile;
    }
    public function validateMobileNumber($mobile){
        if($mobile[0] != 2 && strlen($mobile) != 12)
        {
            throw new \Exception("Invalid Mobile Number");
        }
        return true;
    }
    public function handleMessage($message){
        $uncode = ['ہ' => '06C1','ء' => '0621','آ' => '0622','أ' => '0623','ؤ' => '0624','إ' => '0625','ئ' => '0626','ا' => '0627','ب' => '0628','ة' => '0629','ت' => '062A','ث' => '062B','ج' => '062C','ح' => '062D','خ' => '062E','د' => '062F','ذ' => '0630','ر' => '0631','ز' => '0632','س' => '0633','ش' => '0634','ص' => '0635','ض' => '0636','ط' => '0637','ظ' => '0638','ع' => '0639','غ' => '063A','ف' => '0641','ق' => '0642','ك' => '0643','ل' => '0644','م' => '0645','ن' => '0646','ه' => '0647','و' => '0648','ى' => '0649','ي' => '064A',' '=>'0020','.'=>"00B7",'0'=>'0030','1'=>'0031','2'=>'0032','3'=>'0033','4'=>'0034','5'=>'0035','6'=>'0036','7'=>'0037','8'=>'0038','9'=>'0039','A' => '0041','B' => '0042','C' => '0043','D' => '0044','E' => '0045','F' => '0046','G' => '0047','H' => '0048','I' => '0049','J' => '004A','K' => '004B','L' => '004C','M' => '004D','N' => '004E','O' => '004F','P' => '0050','Q' => '0051','R' => '0052','S' => '0053','T' => '0054','U' => '0055','V' => '0056','W' => '0057','X' => '0058','Y' => '0059','Z' => '005 ','a' => '0061','b' => '0062','c' => '0063','d' => '0064','e' => '0065','f' => '0066','g' => '0067','h' => '0068','i' => '0069','j' => '006A','k' => '006B','l' => '006C','m' => '006D','n' => '006E','o' => '006F','p' => '0070','q' => '0071','r' => '0072','s' => '0073','t' => '0074','u' => '0075','v' => '0076','w' => '0077','x' => '0078','y' => '0079','z' => '007A',];
        $newContent = "";
        $message = preg_split('//u', $message, null, PREG_SPLIT_NO_EMPTY);
        foreach($message as $index => $letter){
            $newContent .= $uncode[$letter];
        }
        return $newContent;
    }
}
