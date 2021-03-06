<?php
// Define o Locale do PHP para pt_BR
setlocale (LC_ALL, 'pt_BR');

// Define a Timezone Default para América/Sao_Paulo
date_default_timezone_set('America/Sao_Paulo');

// Include da class que faz a conexão com o servidor ssh, executa comandos e fecha a conexão
include_once './SSH.class.php';

// Inicia a classe SSH, que no __construct já faz a conexão.
$ssh = new SSH('ServerSSH', 22, 'root', 'root');

// abertura da tag <pre> para ver os dados "como são escritos"
echo '<pre>';

// execução do primeiro comando no servidor SSH, segundo parametro: true -> com retorno.. false -> sem retorno
$ssh->execute("echo \"".date('d/m/Y H:i:s')."\" > /date.txt", false);

// execução do segundo comando no servidor SSH, segundo parametro: true -> com retorno.. false -> sem retorno
print_r($ssh->execute('cat /date.txt', true));

// fecha a tag <pre>
echo '</pre>';

// fecha a conexão com o ssh.
$ssh->close();
