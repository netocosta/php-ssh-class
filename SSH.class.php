<?php

/**
 * Classe para conexão com o servidor ssh, e execução de comandos.
 * Requirements: extension ssh2 1.2 / libssh2 1.8.0
 * Author: Neto Costa <netocjp@gmail.com>
 */
class SSH
{
  private $connection, $stream, $errorStream;

  /**
   * Configurações de conexão
   *
   * @param string $host
   * @param integer $port
   * @param string $user
   * @param string $pass
   */
  private $host, $port, $user, $pass;

  function __construct ($server='localhost', $port=22, $user='root', $pass='root')
  {
    $this->connect($server, $port, $user, $pass);
  }

  /**
   * Conexão do PHP ao servidor SSH
   *
   * @return void
   */
  function connect ($server, $port, $user, $pass)
  {
    $this->connection = ssh2_connect($server, $port);
    ssh2_auth_password($this->connection, $user, $pass);
  }

  /**
   * Executar um comando no bash do servidor ssh.
   *
   * @param string $command
   * @return void
   */
  function execute ($command, $callback=true) 
  {
    $this->stream = ssh2_exec($this->connection, $command);
    $this->errorStream = ssh2_fetch_stream($this->stream, SSH2_STREAM_STDERR);
    stream_set_blocking($this->errorStream, true);
    stream_set_blocking($this->stream, true);

    $return = stream_get_contents($this->stream); 
    $error = stream_get_contents($this->errorStream);

    $lenReturn = strlen($return);
    $lenError = strlen($error);
    $condOne = $lenReturn > 0;
    $condTwo = $lenError == 0;
    $condThree = $lenReturn == 0;

    if ($callback):
      if (($condOne) AND ($condTwo)): return $return;
      elseif (($condTwo) AND ($condThree)): return "Comando não efetua nenhum retorno.";
      else: return $error;
      endif;
    endif;

    return null;

  }

  /**
   * Fechar conexão com o servidor ssh.
   *
   * @return void
   */
  function close ()
  {
    fclose($this->errorStream);
    fclose($this->stream);
  }

}
