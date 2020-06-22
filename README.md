# Class SSH to execute commands via ssh in server remote

### Pre-requisites

extension ssh2 1.2 / libssh2 1.8.0 in php server

### Usage

A finalidade é facilitar o uso, então com isso fica muito fácil executar um comando no bash de qualquer servidor, acessando-o pelo ssh diretamente pelo php.

Veja como é simples, basta configurar o host, user e pass no SSH.class.php e depois:

include_once "SSH.class.php";
$ssh = new SSH;
print_r($ssh->execute("ls -all"));
$ssh->close();

Complete example in: example.php

### Class

Class in SSH.class.php

### Return example.php

![Print example.php](https://i.imgur.com/wmz5LN7.png)
