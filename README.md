# Class SSH to execute commnands via ssh in server remote

### Pre-requisites

extension ssh2 1.2 / libssh2 1.8.0 in php server

### Usage

A finalidade é facilitar o uso, então com isso fica muito fácil executar um comando no bash de qualquer servidor, acessando-o pelo ssh diretamente pelo php.

Veja como é simples, basta configurar o host, user e pass no SSH.class.php e depois:

    <?php
      include_once "SSH.class.php";

      $ssh = new SSH('servidor', 22, 'user', 'pass');
      $ssh->execute("ls -all", true);
      $ssh->close();
    ?>

Complete example in: example.php

### Class

Class in SSH.class.php

### Return example.php

![Print example.php](https://i.imgur.com/wmz5LN7.png)
