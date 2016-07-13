<?php

namespace Cgi\Controllers;

use Core\Controller;
use OAuth;

class ProductsController extends Controller
{

    public function actionPost()
    {
        if ((isset($_POST['mage_url']) && !empty($_POST['mage_url']))){
            $_SESSION['magento_base_url'] = htmlspecialchars($_POST['mage_url']);
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/products/import');
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/');
        }
    }

    public function actionImport()
    {
        $magento_url = $_SESSION['magento_base_url'];
        $callbackUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/products/import';
        $temporaryCredentialsRequestUrl = $magento_url . "oauth/initiate?oauth_callback=" . urlencode($callbackUrl);
        $adminAuthorizationUrl = $magento_url . 'oauth/authorize';
        $accessTokenRequestUrl = $magento_url . 'oauth/token';
        $apiUrl = $magento_url . 'api/rest';
        $consumerKey = 'c349980be5d1ef5e2d4e429a2cce456a';
        $consumerSecret = 'b590331728cd768f29ce20e8c98b1edf';

        if (!isset($_GET['oauth_token']) && isset($_SESSION['state']) && $_SESSION['state'] == 1) {
            $_SESSION['state'] = 0;
        }
        try {
            $authType = ($_SESSION['state'] == 2) ? OAUTH_AUTH_TYPE_AUTHORIZATION : OAUTH_AUTH_TYPE_URI;
            $oauthClient = new OAuth($consumerKey, $consumerSecret, OAUTH_SIG_METHOD_HMACSHA1, $authType);
            $oauthClient->enableDebug();

            if (!isset($_GET['oauth_token']) && !$_SESSION['state']) {
                $requestToken = $oauthClient->getRequestToken($temporaryCredentialsRequestUrl);
                $_SESSION['secret'] = $requestToken['oauth_token_secret'];
                $_SESSION['state'] = 1;
                header('Location: ' . $adminAuthorizationUrl . '?oauth_token=' . $requestToken['oauth_token']);
                exit;
            } else if ($_SESSION['state'] == 1) {
                $oauthClient->setToken($_GET['oauth_token'], $_SESSION['secret']);
                $accessToken = $oauthClient->getAccessToken($accessTokenRequestUrl);
                $_SESSION['state'] = 2;
                $_SESSION['token'] = $accessToken['oauth_token'];
                $_SESSION['secret'] = $accessToken['oauth_token_secret'];
                header('Location: ' . $callbackUrl);
                exit;
            } else {
                $oauthClient->setToken($_SESSION['token'], $_SESSION['secret']);
                $resourceUrl = "$apiUrl/products?page=1&limit=0";
                $oauthClient->fetch($resourceUrl, array(), 'GET', array("Content-Type" => "application/json", "Accept" => "*/*"));
                $productsList = $this->_objectToArray(json_decode($oauthClient->getLastResponse()));
//                foreach ($productsList as $product){
//                    print_r($product);
//                }
                print_r($productsList);
            }
        } catch (\OAuthException $e) {
            print_r($e);
        }
    }

    protected function _objectToArray($obj) {
        if(is_object($obj)) $obj = (array) $obj;
        if(is_array($obj)) {
            $new = array();
            foreach($obj as $key => $val) {
                $new[$key] = $this->_objectToArray($val);
            }
        }
        else $new = $obj;
        return $new;
    }

}