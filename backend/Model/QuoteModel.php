<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class QuoteModel extends Database
{
    public function getQuotes()
    {
        return $this->select("SELECT * FROM quotes ORDER BY id ASC");
    }
}