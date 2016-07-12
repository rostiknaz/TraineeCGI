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

    public $template_view = 'Layouts/main'; // здесь можно указать общий вид по умолчанию.

    public function render($content_view, $data = null)
    {
        include 'App/Cgi/Src/Views/'.$this->template_view . '.php';
    }
}