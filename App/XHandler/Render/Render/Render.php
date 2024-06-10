<?php

namespace App\XHandler\Render\Render;

use App\XHandler\Access\Access;
use App\XHandler\Render\Controller_Render\Controller_Render;
use App\XHandler\Render\Model_Render\Model_Render;
use App\XHandler\Render\View_Render\View_Render;

class Render
{
    private array $CONTROLLER;
    private array $MODEL;
    private array $VIEW;
    private string $ACTION;
    private string $METHOD;
    private array  $QUERY;


    public function __construct()
    {

    }

    public function setController(array $CONTROLLER): void
    {
        $this->CONTROLLER = $CONTROLLER;
    }

    public function getController(): ?array
    {
        return $this->CONTROLLER;
    }

    public function setModel(array $MODEL): void
    {
        $this->MODEL = $MODEL;
    }

    public function getModel(): ?array
    {
        return $this->MODEL;
    }

    public function setAction(string $ACTION): void
    {
        $this->ACTION = $ACTION;
    }

    public function getAction(): string
    {
        return $this->ACTION;
    }

    public function setView(array $VIEW): void
    {
        $this->VIEW = $VIEW;
    }

    public function getView(): array
    {
        return $this->VIEW;
    }

    public function setMethod(string $METHOD): void
    {
        $this->METHOD = $METHOD;
    }

    public function getMethod(): string
    {
        return $this->METHOD;
    }

    
    public function setQuery(array $QUERY): void
    {
        $this->QUERY = $QUERY;
    }

    public function getQuery(): array
    {
        return $this->QUERY;
    }


    public function RENDER(): void
    {
        try {
            $this->METHOD;
            if ($this->METHOD != "GET") {
                Access::START_SESSION();
                self::RENDER_IF_METHOD_IS_NOT_GET();
            } else {
                self::RENDER_IF_METHOD_IS_GET();
            }
        } catch (\Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }


    private function RENDER_IF_METHOD_IS_GET(): void
    {
        // Verificar se, usuario possui permissao com mesmo nome da ACTIOn
        // Exemplo, ACTION_ROTA = deleteUsers ACTION_USER = deleteUsers 
        // SE ACTION_USER EXIST IN ACTION_ROTA Lbiera acesso

        Controller_Render::CONTROLLER_RENDER($this->CONTROLLER, $this->ACTION);
 
        $DATA = Model_Render::MODEL_RENDER($this->MODEL, $this->ACTION);

        include_once View_Render::VIEW_RENDER($this->VIEW);
    }

    private function RENDER_IF_METHOD_IS_NOT_GET(): void
    {
        Controller_Render::CONTROLLER_RENDER($this->CONTROLLER, $this->ACTION);
        // $DATA = Model_Render::MODEL_RENDER($MODEL, $ACTION);
    }
}
