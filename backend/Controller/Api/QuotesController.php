<?php
class QuotesController extends BaseController
{
    /**
     * "/quotes/list" Endpoint - Get list of users
     */
    public function listAction()
    {
        //Intentionally to showoff loading state
        sleep(.5);
        $strErrorDesc = '';
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        //Preflight request
        if (
            isset( $_SERVER['REQUEST_METHOD'] )
            && $requestMethod === 'OPTIONS'
        ) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
            header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');
            exit( 0 );
        }

        $arrQueryStringParams = $this->getQueryStringParams();
        if (strtoupper($requestMethod) == 'GET') {
            try {
                $responseData = json_encode(QuoteModel::getQuotes());
            } catch (Error $e) {
                $strErrorDesc = $e->getMessage().'Something went wrong! Please contact support.';
                $strErrorHeader = 'HTTP/1.1 500 Internal Server Error';
            }
        } else {
            $strErrorDesc = 'Method not supported';
            $strErrorHeader = 'HTTP/1.1 422 Unprocessable Entity';
        }
        // send output
        if (!$strErrorDesc) {
            $this->sendOutput(
                $responseData,
                ['Content-Type: application/json', 'HTTP/1.1 200 OK']
            );
        } else {
            $this->sendOutput(json_encode(['error' => $strErrorDesc]),
                ['Content-Type: application/json', $strErrorHeader]
            );
        }
    }
}