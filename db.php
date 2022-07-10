<?php
class DB
{
    private $dbconn;

    function __construct(string $host, string $port, string $dbname, string $username, string $password)
    {
        $this->dbconn = pg_connect(
            "host=" . $host . " " .
                "port=" . $port . " " .
                "dbname=" . $dbname . " " .
                "user=" . $username . " " .
                "password=" . $password
        );
        echo $this->dbconn == FALSE;
    }

    function queryNotResponse(string $query, array $params = array())
    {
        pg_query_params($this->dbconn, $query, $params);
    }

    function queryResponse(string $query, array $params = array())
    {

        $result = pg_query_params($this->dbconn, $query, $params);
        return pg_fetch_all($result);
    }
}

$database = new DB("localhost", "5432", "crunchyUSM", "postgres", "1234");
