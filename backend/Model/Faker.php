<?php
require_once "Database.php";

class Faker extends Database {

    /**
     * @param array $params
     * Params format is as follows
     * [ 'quote' => ['quote'] ]
     */
    function createQuote($params=[])
    {
        if(empty($params)) return;

        foreach ($params as $quote_and_answers)
        {
            // Used to store the answers so we can call $this->createAnswers
            $answers = [];
            // Get's the comma separated values for the field names
            $quotes_field_names = implode(',', array_keys($quote_and_answers['quote']));
            // Get's the comma separated values for the field values
            $quotes_field_values = $this->customImplode(',', array_values($quote_and_answers['quote']));

            if(key_exists('answers', $quote_and_answers)) {
                $answers = $quote_and_answers['answers'];
                unset($quote_and_answers['answers']);
            }
            $query = "INSERT INTO quotes ( {$quotes_field_names} ) VALUES ({$quotes_field_values})";
            $result = $this->insert($query);

            $this->createAnswers($result['insert_id'], $answers);
        }
    }

    function createAnswers($quote_id = null, $answers = [])
    {
        if(empty($answers)) return;

        foreach($answers as $answer)
        {
            // Get's the comma separated values for the field names
            $answer_field_names = implode(',', array_keys($answer));
            // Get's the comma separated values for the field values
            $answer_field_values = $this->customImplode(',', array_values($answer));

            $query = "INSERT INTO answers ( {$answer_field_names}, quote_id ) VALUES ( {$answer_field_values}, {$quote_id} )";
            $result = $this->insert($query);
        }
    }

    /**
     * Implodes by surrounding strings with '' for query preparation
     * @param array $input
     */
    private function customImplode($separator = ',', $input = [])
    {
        $result = "";
        foreach ($input as $part) {
            $value = '';
            if(gettype($part) == 'string') $result .= '"'.$part.'"'.$separator;
            else $result .= $part.$separator;
        }

        return rtrim($result, ',');
    }
}