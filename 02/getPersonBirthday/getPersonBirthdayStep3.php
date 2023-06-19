<?

// http://code.softblue.com.br/phpexpress/getPersonBirthdayStep1.html

ini_set("default_charset", "UTF-8");
header("Content-Type: text/html; charset=UTF-8");

session_start();

$facebookSdkPath = "./facebook-php-sdk-v4-4.0-dev";

define("FACEBOOK_SDK_V4_SRC_DIR", $facebookSdkPath . "/src/Facebook/");

include $facebookSdkPath . "/autoload.php";

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphUser;
use Facebook\FacebookRequestException;

use Facebook\FacebookRequest;

FacebookSession::setDefaultApplication("847608818638027", "303b8957676da85d2fb743efc6a2df95");

$helper = new FacebookRedirectLoginHelper("http://code.softblue.com.br/phpexpress/getPersonBirthdayStep3.php");

try
{
  $session = $helper->getSessionFromRedirect();
  
  if($session)
  {
    $fr = new FacebookRequest($session, 'GET', '/me');
    $response = $fr->execute();
    $object = $response->getGraphObject();

    echo "<BR>Aniversário: " . $object->getProperty("birthday");
    echo "<BR>E-mail: " . $object->getProperty("email");
  }
  else
  {
    echo "<BR>Sessão não carregada.";
  }
}
catch(FacebookRequestException $ex)
{
  echo "<BR>FacebookRequestException: " . $ex->getMessage();
}
catch(\Exception $ex)
{
  echo "<BR>Exception: " . $ex->getMessage();
}

?>














