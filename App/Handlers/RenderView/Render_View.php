<?php
namespace App\Handlers\RenderView;

class Render_View
{
    public static function Render_View($controller)
    {
        // Caminho do arquivo de visualização
        $viewFilePath = __DIR__ . "/../../View/$controller/$controller" . ".php";

        // Verifica se o arquivo existe antes de incluí-lo
        if (file_exists($viewFilePath)) {
            // Inclui o arquivo de visualização e captura seu conteúdo
            ob_start();
            require_once $viewFilePath;
            $content = ob_get_clean();
            return $content;
        } else {
            // Se o arquivo não existir, retorna uma mensagem de erro
            echo $viewFilePath;
            return "Arquivo de visualização não encontrado.";
        }
    }
}
?>