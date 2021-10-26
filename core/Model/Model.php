<?php

namespace Core\Model;

use Core\Config\Config;
use Exception;
use PDO;

class Model
{

    private $pdo;
    private $query;
    /** List of parameters */
    private $params = [];

    public function __construct()
    {
        $config = new Config();
        $datasource_config = $config->getConfig('dataSource');

        if (!empty($datasource_config['host']) && !empty($datasource_config['database']) && isset($datasource_config['user']) && isset($datasource_config['password'])) {
            $this->pdo = new PDO(
                'mysql:host=' . $datasource_config['host'] . ';dbname=' . $datasource_config['database'],
                $datasource_config['user'],
                $datasource_config['password']
            );
        } else {
            throw new Exception('Please, enter corectly the dataSource configuration in /config/config.php');
        }
    }

    /**
     * This function bind params of the **PDO** request passed in parameter
     *
     * @param [type] $request The request that you want to bind param
     * @return void
     */
    private function _bindParams(&$request)
    {
        foreach ($this->params as $key => $value) {
            $request->bindParam($key, $value, ((is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }
    }

    /**
     * Reset the query to empty string and params to empty array to be ready for next request.
     *
     * @return void
     */
    private function _reset()
    {
        $this->query = '';
        $this->params = [];
    }

    /**
     * Return the **PDO** object of the current instance
     *
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }

    /**
     * Set your **SQL** query string
     * For example : 
     * "select * from my_table where id = :id"
     *
     * @param string $query
     * @return Model
     */
    public function setQuery(string $query): Model
    {
        $this->query = $query;
        return $this;
    }

    /**
     * Bind your param of your query
     *
     * @param string $name The name of your parameter, Must respect the format **:name** 
     * @param [type] $value The value of the param
     * @return Model
     */
    public function bindParam(string $name, $value): Model
    {
        $this->params[$name] = $value;
        return $this;
    }

    /**
     * Bind several params of your query
     *
     * @param array $params **Format :** [':param1' => $value1, ':param2' => $value2, ...]
     * @return Model
     */
    public function bindParams(array $params): Model
    {
        foreach ($params as $key => $value) {
            if (!$this->bindParam($key, $value)) {
                return false;
            }
        }
        return $this;
    }

    /**
     * Execute the query and return all records found for the query
     *
     * @return array Array of the records found for the query
     */
    public function all(): array
    {
        if (empty($this->query)) {
            throw new Exception('The query is empty, set the query with setQuery() function.');
        }
        $request = $this->pdo->prepare($this->query);
        $this->_bindParams($request);
        $request->execute();

        $this->_reset();

        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Execute the query and return the first occurence found
     *
     * @return array Associative array of the result found
     */
    public function first(): array
    {
        if (empty($this->query)) {
            throw new Exception('The query is empty, set the query with setQuery() function.');
        }
        $request = $this->pdo->prepare($this->query);
        $this->_bindParams($request);
        $request->execute();

        $this->_reset();

        return $request->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Execute the query
     *
     * @return boolean True if the request have been executed corectly and False otherwise
     */
    public function execute(): bool
    {
        if (empty($this->query)) {
            throw new Exception('The query is empty, set the query with setQuery() function.');
        }
        $request = $this->pdo->prepare($this->query);
        $this->_bindParams($request);

        $this->_reset();

        return $request->execute();
    }
}
