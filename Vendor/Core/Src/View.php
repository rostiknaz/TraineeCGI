<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 11.07.16
 * Time: 18:12
 */

namespace Core;


class View
{

    //public $template_view; // здесь можно указать общий вид по умолчанию.

    public function render($content_view, $template_view, $data = null)
    {
        include 'App/Cgi/Src/Views/'.$content_view . '.php';
    }
}