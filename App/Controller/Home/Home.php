<?php
namespace App\Controller\Home;
use App\Handlers\RenderView\Render_View;

class Home
{
    public function index($controller)
    {
        return Render_View::Render_View($controller);
    }
}
?>