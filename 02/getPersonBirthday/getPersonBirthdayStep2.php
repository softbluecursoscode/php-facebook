<?

// http://code.softblue.com.br/phpexpress/getPersonBirthdayStep1.html

session_start();

$facebookSdkPath = "./facebook-php-sdk-v4-4.0-dev";

define("FACEBOOK_SDK_V4_SRC_DIR", $facebookSdkPath . "/src/Facebook/");

include $facebookSdkPath . "/autoload.php";

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

FacebookSession::setDefaultApplication("847608818638027", "303b8957676da85d2fb743efc6a2df95");

$helper = new FacebookRedirectLoginHelper("http://code.softblue.com.br/phpexpress/getPersonBirthdayStep3.php");

// Para data de nascimento:
// $params = array("scope" => "user_birthday");

// Para e-mail:
//$params = array("scope" => "email");

$loginUrl = $helper->getLoginUrl();

header("location: " . $loginUrl);

?>
