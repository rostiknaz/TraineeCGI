<?php

namespace Cgi\Controllers;

use Cgi\Model\Product;
use Cgi\Model\User;
use Core\Controller;
use Cgi\Helper\Paginator;
use OAuth;

class ProductsController extends Controller
{
    public function __construct($db_conn)
    {
        parent::__construct();
        $this->_dbConn = $db_conn;
        $user = new User($this->_dbConn);
        if(!$user->isAuthenticated()){
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/login');
        }
    }

    public function actionIndex()
    {
        $this->actionList();
    }

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
                $product = new Product($this->_dbConn);
                $product->importProducts($productsList);
                $message = [
                    'success' => 'Products are imported!!'
                ];
                $this->actionList($message);
            }
        } catch (\OAuthException $e) {
            $message = [
                'danger' => $e->getMessage()
            ];
            $this->actionList($message);
        }
    }

    public function actionList($message = [])
    {
        if((isset($_GET['limit']) && !empty($_GET['limit']))) {
            $_SESSION['page_limit'] = $this->_trimInjection($_GET['limit']);
        }
        $product    = new Product($this->_dbConn);
        $column     = (isset($_GET['column'])         && !empty($_GET['column']))          ? $_GET['column']          : 'product_id';
        $sort       = (isset($_GET['sort'])           && !empty($_GET['sort']))            ? $_GET['sort']            : 'ASC';
        $limit      = (isset($_SESSION['page_limit']) && !empty($_SESSION['page_limit']))  ? $_SESSION['page_limit']  : 15;
        $page       = (isset($_GET['page'])           && !empty($_GET['page']))            ? $_GET['page']            : 1;
        $products   = $product->getAllProducts($column, $sort, $page, $limit);

        $tag_name['price'] = ($column == 'final_price_with_tax' && $sort == 'ASC') ? 'down' : 'up';
        $tag_name['name']  = ($column == 'name'                 && $sort == 'ASC') ? 'down' : 'up';
        $data = [
            'title'    => 'Product List',
            'products' => $products,
            'tag_name' => $tag_name,
            'message'  => $message
        ];
        $this->_view->render('list',$data);
    }

    public function actionEdit()
    {
        $product = new Product($this->_dbConn);
        $data = [];
        if(isset($_GET['id']) && !empty($_GET['id'])){
            $chekProduct = $product->checkProduct($_GET['id']);
            if($chekProduct){
                $product->load($_GET['id']);
                $data = [
                    'title'    => $product->getName(),
                    'product' => $product,
                ];
                $this->_view->render('edit',$data);
            } else {
                header('Location: http://' . $_SERVER['HTTP_HOST'] . '/products/list');
            }
        } elseif (!empty($_POST['name']) && !empty($_POST['sku'])&& !empty($_POST['description'])){
            $post_data = $_POST;
            $new_data = [];
            foreach ($post_data as $key=>$item){
                $new_data[$key] = $this->_trimInjection($item);
            }
            if($product->validate($new_data)){
                $product->setData($new_data);
                $product->save();
                $product->load($new_data['product_id']);
                $data = [
                    'title' => $product->getName(),
                    'success' => 'Product has been saved!!',
                    'product'=> $product
                ];
                $this->_view->render('edit',$data);
            } else {
                $product->load($new_data['product_id']);
                $data = [
                    'title' => $product->getName(),
                    'errors' => $product->errors,
                    'product'=> $product
                ];
                $this->_view->render('edit',$data);
            }
        } else {
            header('Location: http://' . $_SERVER['HTTP_HOST'] . '/products/list');
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