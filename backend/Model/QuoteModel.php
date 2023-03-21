<?php
require_once PROJECT_ROOT_PATH . "/Model/Database.php";

class QuoteModel extends Database
{
    public static function getQuotes()
    {
        $db = new Database();
        $quote_answers = $db->select("
            SELECT q.id AS quoteId, q.quote, a.answer, a.correct, a.quote_id FROM quotes q
            LEFT JOIN answers a on q.id = a.quote_id
            ORDER BY q.id
        ");

        $data = [];

        /**
         * Basically I'm taking all answers and grouping them by quote in this format
         * [
         *  {
         *       "quoteText": "The greatest glory in living lies not in never falling, but in rising every time we fall"
         *       "answers": [
         *           {
         *               'answer': 'Nelson Mandela',
         *                  'correct': 1
         *              },
         *           ...
         *          ]
         *
         *  },...
         * ]
         */
        foreach ($quote_answers as $quote_answer) {
            // Check if the quote Id exists in the array, if it does NOT we take the Quote Text and insert the first asnswer on that quote
            if(!array_key_exists($quote_answer['quoteId'], $data)) {
                $data[$quote_answer['quoteId']] = [
                    'quoteText' => $quote_answer['quote'],
                    'answers' => [
                        ['answer' => $quote_answer['answer'], 'correct' => $quote_answer['correct']]
                    ]
                ];
            }
            // If the quoteId exists in the array we simply append the next answer to the Quote
            else {
                array_push($data[$quote_answer['quoteId']]['answers'], ['answer' => $quote_answer['answer'], 'correct' => $quote_answer['correct']]);
            }
        }

        return array_values($data);
    }
}