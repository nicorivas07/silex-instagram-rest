<?php
namespace AppName\Controller;

use Silex\Application;

/**
 * Default Controller Description
 *
 * @author Nicolas Rivas <nicolasrivas07@gmail.com>
 */
class DefaultController
{
    public function indexAction($name = "Guess")
    {
        $message = "Welcome $name to SilexLand";
        return $message;
    }
}