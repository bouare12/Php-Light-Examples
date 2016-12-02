<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 29/11/16
 * Time: 14:05
 */

namespace Romenys\app;

use Romenys\Framework\Components\HandleRequest;

class AppKernel
{
    public function __construct()
    {
        if (!session_start()) throw new RuntimeException("We were unable to start a session", 403);

        $_POST = empty($_POST) ? $_POST = empty(json_decode(file_get_contents('php://input'),true)) ? $_POST : json_decode(file_get_contents('php://input'),true) : $_POST;

        $request = new HandleRequest($_GET, $_POST, $_COOKIE, $_FILES, $_ENV, $_SESSION, $_SERVER);
        $request->handleRequest();
    }
}
