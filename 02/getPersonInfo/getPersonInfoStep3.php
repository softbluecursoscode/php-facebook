<?

// http://code.softblue.com.br/phpexpress/getPersonInfoStep1.html

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

$helper = new FacebookRedirectLoginHelper("http://code.softblue.com.br/phpexpress/getPersonInfoStep3.php");

try
{
  $session = $helper->getSessionFromRedirect();
  
  if($session)
  {
    $fr = new FacebookRequest($session, 'GET', '/me');
    $response = $fr->execute();
    $object = $response->getGraphObject();
    
    echo "<BR>Nome: " . $object->getProperty("name");
    echo "<BR>Sexo: " . $object->getProperty("gender");

    echo "<BR>E-mail: " . $object->getProperty("email");
    echo "<BR>Aniversário: " . $object->getProperty("birthday");
    
    $url = $object->getProperty("link");
    echo "<BR><A href='" . $url . "'>Acessar usuário (" . $url . ")</A>";

    $pictureUrl = $object->getProperty("link");
    $pictureUrl = str_replace("www.", "graph.", $pictureUrl);
    $pictureUrl = str_replace("app_scoped_user_id/", "", $pictureUrl);
    $pictureUrl .= "picture";
    
    echo "<BR><IMG src='" . $pictureUrl . "'>";
    echo "<BR><IMG src='" . $pictureUrl . "?type=large'>";
    echo "<BR><IMG src='" . $pictureUrl . "?type=normal'>";
    echo "<BR><IMG src='" . $pictureUrl . "?type=small'>";

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














