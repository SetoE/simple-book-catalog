<?php
namespace App\Controller;

use Jenssegers\Blade\Blade;

class Controller
{
    
    public function render($view, $params)
    {
        $blade = new Blade('App/Views', 'cache');

        echo $blade->render($view, $params);
    }
}