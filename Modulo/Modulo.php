<?php

echo "Digite o caminho do arquivo e o arquivo que você deseja criar exemplo: /Perfil/UserPerfil/UserPerfil: \n";
$CAMINHO_DO_MODULO = trim(fgets(STDIN));

if (empty($CAMINHO_DO_MODULO))
{
    echo "Nome de arquivo inválido. Por favor, tente novamente.";
    exit;
}

// Divide o caminho completo em partes separadas pelo separador de diretório do sistema
$CAMINHO_DO_MODULO_EM_PARTES = explode('/', $CAMINHO_DO_MODULO);

// Armazena o último elemento do array antes de removê-lo
$NOME_DO_ARQUIVO = end($CAMINHO_DO_MODULO_EM_PARTES);

// Remove o nome do arquivo das partes do caminho
array_pop($CAMINHO_DO_MODULO_EM_PARTES);

$CAMINHO_PARA_NAMESPACE = implode('/', $CAMINHO_DO_MODULO_EM_PARTES); // Convertendo array em string
$NAMESPACE_DO_MODULO = str_replace('/', '\\', $CAMINHO_PARA_NAMESPACE);

$diretorioBaseController = __DIR__ . "/../App/Controller/";
$diretorioBaseModel = __DIR__ . "/../App/Model/";
$diretorioBaseView = __DIR__ . "/../App/View/";
$diretorioBaseTestesUnit = __DIR__ . "/../Tests/Unit/";

// Verifica se os diretórios base existem e, se não, os cria
foreach ([$diretorioBaseController, $diretorioBaseModel, $diretorioBaseView, $diretorioBaseTestesUnit] as $diretorio) {
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true); // Cria a pasta com permissões de escrita (0777)
    }
}

// Caminho completo para os diretórios de Controller, Model, View e Tests/Unit
$caminhoBaseController = $diretorioBaseController . implode('/', $CAMINHO_DO_MODULO_EM_PARTES);
$caminhoBaseModel = $diretorioBaseModel . implode('/', $CAMINHO_DO_MODULO_EM_PARTES);
$caminhoBaseView = $diretorioBaseView . implode('/', $CAMINHO_DO_MODULO_EM_PARTES);
$caminhoBaseTests = $diretorioBaseTestesUnit . implode('/', $CAMINHO_DO_MODULO_EM_PARTES);

// Verifica se os diretórios existem e, se não, os cria
foreach ([$caminhoBaseController, $caminhoBaseModel, $caminhoBaseView, $caminhoBaseTests] as $diretorio) {
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true); // Cria a pasta com permissões de escrita (0777)
    }
}

$CONTEUDO_CONTROLLER = "<?php\n\nnamespace App\\Controller$NAMESPACE_DO_MODULO;\n\nuse App\\Model$NAMESPACE_DO_MODULO\\$NOME_DO_ARQUIVO as ${NOME_DO_ARQUIVO}Model;\n\nclass $NOME_DO_ARQUIVO\n{\n    public static function get()\n    {\n        // Implementação da função GET\n    }\n\n    public static function post()\n    {\n        // Implementação da função POST\n        ${NOME_DO_ARQUIVO}Model::post();\n    }\n}\n\n?>";

$CONTEUDO_MODEL = "<?php\n\nnamespace App\\Model$NAMESPACE_DO_MODULO;\n\nclass $NOME_DO_ARQUIVO\n{\n    public static function get()\n    {\n        // Implementação da função GET\n        \$DATA = str_replace('$NOME_DO_ARQUIVO', __CLASS__, '$NOME_DO_ARQUIVO - Works');\n        return \$DATA;\n    }\n\n    public static function post()\n    {\n        // Implementação da função POST\n    }\n}\n\n?>";

$CONTEUDO_VIEW = "<!DOCTYPE html>\n<html>\n<head>\n    <title>$NOME_DO_ARQUIVO</title>\n</head>\n<body>\n\n   <h1><?php echo \$DATA; ?></h1> <!-- Seu código HTML aqui -->\n</body>\n</html>";

$CONTEUDO_TESTS = "<?php \n\nnamespace Testes\\Unit$NAMESPACE_DO_MODULO; \n\nuse App\\Controller\\$NOME_DO_ARQUIVO\\$NOME_DO_ARQUIVO as ${NOME_DO_ARQUIVO}Controller;\n\nuse PHPUnit\Framework\TestCase;\n\nclass test$NOME_DO_ARQUIVO extends TestCase\n{\n\n} \n\n?>";

$arquivoController = $caminhoBaseController . DIRECTORY_SEPARATOR . $NOME_DO_ARQUIVO . '.php';
$arquivoModel = $caminhoBaseModel . DIRECTORY_SEPARATOR . $NOME_DO_ARQUIVO . '.php';
$arquivoView = $caminhoBaseView . DIRECTORY_SEPARATOR . $NOME_DO_ARQUIVO . '.php';
$arquivoTests = $caminhoBaseTests . DIRECTORY_SEPARATOR . $NOME_DO_ARQUIVO . '.php';

file_put_contents($arquivoController, $CONTEUDO_CONTROLLER);
file_put_contents($arquivoModel, $CONTEUDO_MODEL);
file_put_contents($arquivoView, $CONTEUDO_VIEW);
file_put_contents($arquivoTests, $CONTEUDO_TESTS);



// Caminho para o arquivo Routes.php
$arquivoRoutes = __DIR__ . "/../App/XHandler/Router/Routes/Routes.php";


$ROUTE_NAME = strtolower(str_replace('\\', '/', $NAMESPACE_DO_MODULO));



// Define a nova rota completa
$novaRota = "
            \"$ROUTE_NAME\" => [
                \"GET\" => [
                    \"Controller\" => \"" . ltrim(str_replace('\\', '/', implode('/', $CAMINHO_DO_MODULO_EM_PARTES)), '/') . "@get\",
                ],
                \"POST\" => [
                    \"Controller\" => \"" . ltrim(str_replace('\\', '/', implode('/', $CAMINHO_DO_MODULO_EM_PARTES)), '/') . "@post\",
                ],
            ],
    ";

// Obtém o conteúdo atual do arquivo
$conteudoArquivo = file_get_contents($arquivoRoutes);

// Verifica se o conteúdo foi lido com sucesso
if ($conteudoArquivo !== false) {
    // Verifica se a nova rota já existe no arquivo
    if (strpos($conteudoArquivo, $novaRota) !== false) {
        echo "A rota já existe no arquivo Routes.php";
    } else {
        // Encontra a posição onde o retorno de routes() termina
        $posicaoFim = strrpos($conteudoArquivo, "];");

        // Separa o conteúdo antes e depois do retorno de routes()
        $inicio = substr($conteudoArquivo, 0, $posicaoFim);
        $fim = substr($conteudoArquivo, $posicaoFim);

        // Adiciona a nova rota ao conteúdo do arquivo
        $conteudoArquivo = $inicio . $novaRota . $fim;

        // Escreve o conteúdo modificado de volta ao arquivo
        if (file_put_contents($arquivoRoutes, $conteudoArquivo) !== false) {
            echo "Nova rota adicionada com sucesso ao arquivo Routes.php";
        } else {
            echo "Erro ao escrever a nova rota no arquivo Routes.php";
        }
    }
} else {
    echo "Erro ao ler o arquivo Routes.php";
}




?>
