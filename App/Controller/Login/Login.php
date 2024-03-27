<?php
namespace App\Controller\Login;
use App\Handlers\RenderView\Render_View;

class Login
{
    public function index($controller)
    {
        return Render_View::Render_View($controller);
    }
}
?>