<?php
class Controller
{
    const DEFAULT_CONTROLLER  = 'Main';
    const DEFAULT_ACTION = 'Index';
    public static function handleRequest()
    {
        $controller = isset($_REQUEST['controller']) ? $_REQUEST['controller'] : Controller::DEFAULT_CONTROLLER; //if not set, default controller
        $controller .= 'Controller';

        $method = $_SERVER['REQUEST_METHOD'];

        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : Controller::DEFAULT_ACTION;

        $m = $method .'_'. $action;
        (new $controller)->$m();
    }

    public final function renderView($view, $model = null)
    {
        ViewRenderer::renderView($view, $model);
    }
    public static function buildActionLink($action, $controller, $params = null)
    {
        $res = '?action=' .rawurlencode($action).'&controller='.rawurlencode($controller);
        if(is_array($params))
        {
            foreach ($params as $name => $value)
            {
                $res .= '&' . rawurlencode($name) .'='.rawurlencode($value);
            }
        }

        return $res;
    }
    public final function hasParameter($id)
    {
        return isset($_REQUEST[$id]);
    }
    public final function getParameter($id)
    {
        if($this->hasParameter($id))
        {
            return $_REQUEST[$id];
        }
        else
        {
            return null;
        }
    }
    public final function redirectToUrl($url)
    {
        header("Location: $url");
    }
    public final function redirect($action, $controller, $params=null)
    {
        $this->redirectToUrl(self::buildActionLink($action, $controller, $params));
    }
}