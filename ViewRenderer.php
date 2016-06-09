<?php

class ViewRenderer
{
    public static function renderView($view, $model = null)
    {
        require('Views/' .$view . '.inc');
    }

    private static function actionLink($content, $action, $controller, $styleclass = null, $params = null)
    {
        $url = Controller::buildActionLink($action, $controller, $params);
        echo ("<a class='$styleclass' href='$url'>");
        echo ($content);
        echo ("</a>");
    }
    private static function out($string)
    {
        echo(nl2br(htmlentities($string)));
    }

    private static function beginActionForm($action, $controller, $params=null, $method='get')
    {
        $form = <<<FORM
        <form class="form-signin" method="$method">
            <input type="hidden" name="controller" value="$controller" />
            <input type="hidden" name="action" value="$action"/>
FORM;
        echo($form);

        if(is_array($params))
        {
            foreach ($params as $name => $value)
            {
                $form = "<input type='hidden' name='$name' value='$value' />";
                echo ($form);
            }
        }
    }

    private static function endActionForm()
    {
        echo("</form>");
    }

}