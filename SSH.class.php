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
  private $host = "ServerSSH";
  private $port = 22;
  private $user = "root";
  private $pass = "root";

  function __construct ()
  {
    $this->connect();
  }

  /**
   * Conexão do PHP ao servidor SSH
   *
   * @return void
   */
  function connect ()
  {
    $this->connection = ssh2_connect('ServerSSH', 22);
    ssh2_auth_password($this->connection, 'root', 'root');
  }

  /**
   * Executar um comando no bash do servidor ssh.
   *
   * @param string $command
   * @return void
   */
  function execute ($command) 
  {
    $this->stream = ssh2_exec($this->connection, $command);
    $this->errorStream = ssh2_fetch_stream($this->stream, SSH2_STREAM_STDERR);
    stream_set_blocking($this->errorStream, true);
    stream_set_blocking($this->stream, true);

    $return = stream_get_contents($this->stream); 
    $error = stream_get_contents($this->errorStream);

    $condOne = strlen($return) > 0;
    $condTwo = strlen($error) == 0;
    $condThree = strlen($return) == 0;

    if (($condOne) AND ($condTwo)) {
      return "<b>Command:</b> {$command}<br /><b>Retorno:</b><br />{$return}<br /><br />";
    } elseif (($condTwo) AND ($condThree)) {
      return "<b>Command:</b> {$command}.<br /><b>Retorno:</b><br />Comando não efetua nenhum retorno.<br /><br />";
    } else {
      return "<b>Command:</b> {$command}<br /><b>Retorno:</b><br />{$error}<br /><br />";
    }

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
