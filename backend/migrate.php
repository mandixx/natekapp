<?php
include './Model/Database.php';
try {
    // Define DB Connection
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

    /**
     * Create 'quotes' table
     * id - key
     * quote - TEXT(255) not null
     */
    $mysqli->query("DROP TABLE IF EXISTS quotes");
    $mysqli->query("
        create table quotes(
        id int auto_increment,
        quote varchar(255) not null,
        primary key(id)
    );");
    echo "Table 'quotes' created, successfully\n";


    /**
     * Create 'answers' table
     * id - key
     * answer - TEXT(255) not null
     * correct - bool default false - This is how we flag if the answer for a quote is correct or not
     * quote_id - foreign key - How we connect the answers to each quote ( one to many )
     */
    $mysqli->query("DROP TABLE IF EXISTS answers");
    $mysqli->query("
        create table answers(
        id int auto_increment,
        answer varchar(255) not null,
        correct bool default false,
        quote_id INT NOT NULL,
        primary key(id),
        foreign key(quote_id)
            references quotes(id)                 
    );");

    echo "Table 'answers' created, successfully\n";
} catch (Exception $e) {
    echo "Migration failed due to error: \n";
    echo $e->getMessage();
}
