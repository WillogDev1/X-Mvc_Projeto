<?php

// Solicita que o usuário digite o nome do arquivo que deseja criar
echo "Digite o nome do arquivo que você deseja criar: ";
$nomeArquivo = trim(fgets(STDIN)); // Obtém a entrada do usuário

// Verifica se o nome do arquivo é válido
if (empty($nomeArquivo)) {
    echo "Nome de arquivo inválido. Por favor, tente novamente.";
    exit;
}

// Define o conteúdo para o Controller
$conteudoController = "<?php\n\nnamespace App\\Controller\\$nomeArquivo;\n\nuse App\\Model\\$nomeArquivo\\$nomeArquivo as ${nomeArquivo}Model;\n\nclass $nomeArquivo\n{\n    public static function get()\n    {\n        // Implementação da função GET\n    }\n\n    public static function post()\n    {\n        // Implementação da função POST\n        ${nomeArquivo}Model::post();\n    }\n}\n\n?>";

$conteudoTests = "<?php \n\nnamespace Testes\\Unit\\$nomeArquivo; \n\nuse App\\Controller\\$nomeArquivo\\$nomeArquivo as ${nomeArquivo}Controller;\n\nuse PHPUnit\Framework\TestCase;\n\nclass test$nomeArquivo extends TestCase\n{\n\n} \n\n?>";

// Define o conteúdo para o Model
$conteudoModel = "<?php\n\nnamespace App\\Model\\$nomeArquivo;\n\nclass $nomeArquivo\n{\n    public static function get()\n    {\n        // Implementação da função GET\n        \$DATA = str_replace('$nomeArquivo', __CLASS__, '$nomeArquivo - Works');\n        return \$DATA;\n    }\n\n    public static function post()\n    {\n        // Implementação da função POST\n    }\n}\n\n?>";

// Define o conteúdo para a View
$conteudoView = "<!DOCTYPE html>\n<html>\n<head>\n    <title>$nomeArquivo</title>\n</head>\n<body>\n\n   <h1><?php echo \$DATA; ?></h1> <!-- Seu código HTML aqui -->\n</body>\n</html>";

// Define o caminho completo do diretório para cada tipo (Controller, Model, View)
$diretorios = [
    __DIR__ . "/../App/Controller/$nomeArquivo/",
    __DIR__ . "/../App/Model/$nomeArquivo/",
    __DIR__ . "/../App/View/$nomeArquivo/",
    __DIR__ . "/../Tests/Unit/$nomeArquivo/"
];

// Cria os diretórios se ainda não existirem
foreach ($diretorios as $diretorio) {
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true); // Cria a pasta com permissões de escrita (0777)
    } else {
        echo "O diretório '$diretorio' já existe.";
        exit;
    }
}

// Conteúdos para cada tipo de arquivo
$conteudos = [
    'Controller' => $conteudoController,
    'Model' => $conteudoModel,
    'View' => $conteudoView,
    'Tests' => $conteudoTests
];

// Cria o arquivo em cada diretório com o conteúdo correspondente
foreach ($diretorios as $key => $diretorio) {
    $tipo = ['Controller', 'Model', 'View', 'Tests'][$key];
    $arquivo = $diretorio . $nomeArquivo . '.php';
    file_put_contents($arquivo, $conteudos[$tipo]);
    echo "Arquivo '$arquivo' criado com sucesso no diretório '$diretorio'!\n";
}

// Caminho para o arquivo Routes.php
$arquivoRoutes = __DIR__ . "/../App/XHandler/Router/Routes/Routes.php";

$rota = strtolower($nomeArquivo);

// Define a nova rota
$novaRota = "
            \"/$rota\" => [
                \"GET\" => [
                    \"Controller\" => \"$nomeArquivo@get\",
                ],
                \"POST\" => [
                    \"Controller\" => \"$nomeArquivo@post\",
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
