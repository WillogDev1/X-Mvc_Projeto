<?php

namespace Testes\Unit\Login;

use App\Controller\Login\Login as LoginController;

use PHPUnit\Framework\TestCase;

class testLogin extends TestCase
{
    public function testValidEmailAndPassword()
    {
        $loginController = new LoginController();
        $validEmail = "bill.omar@gmail.com";

        $result = $loginController->verifiy_email($validEmail);

        // Assert que a verificação do e-mail válido retorna true
        $this->assertTrue($result);
    }

}
?>