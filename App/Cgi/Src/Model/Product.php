<?php
namespace Cgi\Model;

use Cgi\Helper\Validator;
use Core\Model;
use Cgi\Helper\Paginator;

class Product extends Model
{
    public $errors;

    /**
     * @var array|null Product data.
     */
    protected $_product;

    /**
     * Call parent construct for connection to db.
     *
     * @param object $connect_db
     */
    public function __construct($connect_db)
    {
        parent::__construct($connect_db, $this->_getTableName(), $this->_getIdFieldName());
    }

    /**
     * Get table name
     *
     * @return string
     */
    protected function _getTableName()
    {
        return 'products';
    }

    /**
     * Get name of 'id' field
     *
     * @return string
     */
    protected function _getIdFieldName()
    {
        return 'product_id';
    }

    /**
     * Get all data
     *
     * @return array
     */
    protected function _getData()
    {
        return (array) $this->_product;
    }
    /**
     * Get product name
     *
     * @return null|string
     */
    public function getName()
    {
        return  !isset($this->_product['name']) ? null : $this->_product['name'];
    }

    /**
     * Get sku
     *
     * @return null|string
     */
    public function getSku()
    {
        return  !isset($this->_product['sku']) ? null : $this->_product['sku'];
    }

    /**
     * Get product status
     *
     * @return null|bool
     */
    public function getStatus()
    {
        return  !isset($this->_product['is_saleable']) ? null : $this->_product['is_saleable'];
    }

    /**
     * Get product description
     *
     * @return null|string
     */
    public function getDescription()
    {
        return  !isset($this->_product['description']) ? null : $this->_product['description'];
    }

    /**
     * Get product price
     *
     * @return null|string
     */
    public function getPrice()
    {
        return  !isset($this->_product['final_price_with_tax']) ? null : $this->_product['final_price_with_tax'];
    }

    /**
     * Get product last updated date
     *
     * @return null|string
     */
    public function getUpdatedDate()
    {
        return  !isset($this->_product['updated_date']) ? null : $this->_product['updated_date'];
    }

    /**
     * Get record id
     *
     * @return int|null
     */
    public function getId()
    {
        return  !isset($this->_product['product_id']) ? null : $this->_product['product_id'];
    }

    /**
     * Set data record.
     *
     * @param array $data
     */
    public function setData($data)
    {
        $this->_product = $data;
    }

    /**
     * Set product sku
     *
     * @param string $sku Product sku.
     */
    protected function _setId($sku)
    {
        $this->_product[$this->_getIdFieldName()] = $sku;
    }


    public function importProducts($products)
    {
        foreach($products as $product){
            $import_product = $this->getProductBySku($product['sku']);
            $this->setData($product);
            if(empty($import_product)){
                $this->_create();
            } else {
                $this->_update();
            }
        }
    }

    public function checkProduct($product_id)
    {
        return (bool) !empty($this->_getById($product_id));
    }

    public function getProductBySku($sku)
    {
        $sql = 'SELECT * FROM' . ' ' . $this->_getTableName() . ' ' . 'WHERE  sku = ?';
        $result = null;
        try {
            $sth = $this->_execute($sql,array($sku));
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function getAllProducts($column, $sort, $page, $limit)
    {
        $sql = 'SELECT * FROM' . ' ' . $this->_getTableName() . ' ' .
               'ORDER BY ' . $column . ' ' . $sort  ;
        $result        = null;
        $paginator     = new Paginator($this->_conn, $sql);
        try {
            $result    = $paginator->getData($limit, $page);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
        return [
            'paginator' => $paginator,
            'result'    => $result,
            'column'    => $column,
            'sort'      => $sort,
            'page'      => $page,
            'limit'     => $limit
        ];
    }

    public function validate($product)
    {
        $result = [];
        $validator = new Validator();
        foreach ($product as $key=>$item){
            switch ($key){
                case 'name':
                    $result[] = (int) $validator->validateTextInput($item);
                    break;
                case 'sku':
                    $result[] = (int) $validator->validateVarcharInput($item);
                    break;
                case 'description':
                    $result[] = (int) $validator->validateTextInput($item);
                    break;
                case 'final_price_with_tax':
                    $result[] = (int) $validator->validateFloatInput($item);
                    break;
                case 'is_saleable':
                    $result[] = (int) $validator->validateBoolInput($item);
                    break;
            }
        }
        $this->errors = $validator->errors;
        return ((array_search(0, $result) !== false) ? false : true);
    }


}