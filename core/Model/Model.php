<?php

namespace Core\Model;

use Core\Config\Config;
use Exception;
use PDO;

class Model
{

    private $pdo;
    private $query;
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

    private function _bindParams(&$request)
    {
        foreach ($this->params as $key => $value) {
            $request->bindParam($key, $value, ((is_int($value)) ? PDO::PARAM_INT : PDO::PARAM_STR));
        }
    }

    private function _reset()
    {
        $this->query = '';
        $this->params = [];
    }

    public function getPdo()
    {
        return $this->pdo;
    }

    public function setQuery(string $query): Model
    {
        $this->query = $query;
        return $this;
    }

    public function bindParam(string $name, $value): Model
    {
        $this->params[$name] = $value;
        return $this;
    }

    public function bindParams(array $params)
    {
        foreach ($params as $key => $value) {
            if (!$this->bindParam($key, $value)) {
                return false;
            }
        }
        return $this;
    }

    public function all()
    {
        $request = $this->pdo->prepare($this->query);
        $this->_bindParams($request);
        $request->execute();

        $this->_reset();

        return $request->fetchAll(PDO::FETCH_ASSOC);
    }

    public function first()
    {
        $request = $this->pdo->prepare($this->query);
        $this->_bindParams($request);
        $request->execute();

        $this->_reset();

        return $request->fetch(PDO::FETCH_ASSOC);
    }

    public function execute(): bool
    {
        $request = $this->pdo->prepare($this->query);
        $this->_bindParams($request);

        $this->_reset();

        return $request->execute();
    }
}
