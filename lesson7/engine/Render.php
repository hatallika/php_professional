<?php

namespace app\engine;

use app\interfaces\IRenderer;

class Render implements IRenderer
{
    public function renderTemplate($template, $params=[])
    {//layout//catalog
        ob_start();
        extract($params);
        $templatePath = VIEWS_DIR . $template . ".php";
        include $templatePath;
        return  ob_get_clean();
    }
}