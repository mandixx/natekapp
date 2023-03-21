<?php
include './Inc/config.php';
include './Model/Database.php';
include './Model/Faker.php';
try {
    // Define DB Connection
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE_NAME);

    /**
     * Create 'quotes' table
     * id - key
     * quote - TEXT(255) not null
     */
    $mysqli->query("SET FOREIGN_KEY_CHECKS=0");
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
    $mysqli->query("SET FOREIGN_KEY_CHECKS=1");

    echo "Table 'answers' created, successfully\n";

    echo "Starting dummy data inserts...\n";

    $faker = new Faker();
    $faker->createQuote([
        [
            'quote' => ['quote' => 'The greatest glory in living lies not in never falling, but in rising every time we fall.'],
            'answers' => [
                ['answer' => 'Nelson Mandela', 'correct' => 1],
                ['answer' => 'Diego Maradona', 'correct' => 0],
                ['answer' => 'Cristiano Ronaldo', 'correct' => 0],
                ['answer' => 'Helen Keller', 'correct' => 0],
            ]
        ],
        [
            'quote' => ['quote' => 'The way to get started is to quit talking and begin doing.'],
            'answers' => [
                ['answer' => 'Walt Disney', 'correct' => 1],
                ['answer' => 'Kiley Jenner', 'correct' => 0],
                ['answer' => 'Guide Marsaldi', 'correct' => 0],
                ['answer' => 'Catrin Belveth', 'correct' => 0]
            ]
        ],
        [
            'quote' => ['quote' => "If you look at what you have in life, you'll always have more. If you look at what you don't have in life, you'll never have enough."],
            'answers' => [
                ['answer' => 'Oprah Winfrey', 'correct' => 1],
                ['answer' => 'Guide Marsaldi', 'correct' => 0],
                ['answer' => 'Walt Disney', 'correct' => 0],
                ['answer' => 'Nelson Mandela', 'correct' => 0]
            ]
        ],
        [
            'quote' => ['quote' => "If you set your goals ridiculously high and it's a failure, you will fail above everyone else's success."],
            'answers' => [
                ['answer' => 'James Cameron', 'correct' => 1],
                ['answer' => 'Diego Maradona', 'correct' => 0],
                ['answer' => 'Nelson Mandela', 'correct' => 0],
                ['answer' => 'Helen Keller', 'correct' => 0],

            ]
        ],
        [
            'quote' => ['quote' => 'Do not go where the path may lead, go instead where there is no path and leave a trail.'],
            'answers' => [
                ['answer' => 'Ralph Waldo Emerson', 'correct' => 1],
                ['answer' => 'Anne Frank', 'correct' => 0],
                ['answer' => 'Eleanor Roosevelt', 'correct' => 0],
                ['answer' => 'Mother Teresa', 'correct' => 0],
            ]
        ],
        [
            'quote' => ['quote' => 'Spread love everywhere you go. Let no one ever come to you without leaving happier.'],
            'answers' => [
                ['answer' => 'Mother Teresa', 'correct' => 1],
                ['answer' => 'Robert Louis Stevenson', 'correct' => 0],
                ['answer' => 'Eleanor Roosevelt', 'correct' => 0],
                ['answer' => 'Helen Keller', 'correct' => 0],
            ]
        ],
        [
            'quote' => ['quote' => 'Whoever is happy will make others happy too.'],
            'answers' => [
                ['answer' => 'Anne Frank', 'correct' => 1],
                ['answer' => 'Robert Louis Stevenson', 'correct' => 0],
                ['answer' => 'Eleanor Roosevelt', 'correct' => 0],
                ['answer' => 'Helen Keller', 'correct' => 0],

            ]
        ],
        [
            'quote' => ['quote' => 'You will face many defeats in life, but never let yourself be defeated.'],
            'answers' => [
                ['answer' => 'Maya Angelou', 'correct' => 1],
                ['answer' => 'Ralph Waldo Emerson', 'correct' => 0],
                ['answer' => 'Eleanor Roosevelt', 'correct' => 0],
                ['answer' => 'Helen Keller', 'correct' => 0],
            ]
        ],
        [
            'quote' => ['quote' => "In the end, it's not the years in your life that count. It's the life in your years."],
            'answers' => [
                ['answer' => 'Abraham Lincoln', 'correct' => 1],
                ['answer' => 'Ralph Waldo Emerson', 'correct' => 0],
                ['answer' => 'Maya Angelou', 'correct' => 0],
                ['answer' => 'Eleanor Roosevelt', 'correct' => 0],
            ]
        ],
        [
            'quote' => ['quote' => 'Life is either a daring adventure or nothing at all.'],
            'answers' => [
                ['answer' => 'Helen Keller', 'correct' => 1],
                ['answer' => 'Abraham Lincoln', 'correct' => 0],
                ['answer' => 'Dr. Seuss', 'correct' => 0],
                ['answer' => 'Helen Karalel', 'correct' => 0],
            ]
        ]
    ]);
    echo "Dummy data successfully inserted";
} catch (Exception $e) {
    echo "Migration failed due to error: \n";
    echo $e->getMessage();
}
