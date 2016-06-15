<?php
session_start();

// require_once ('php/testarSessao.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title>OCG</title>
    </head>
</head>
<frameset rows="18%,*" cols="*" frameborder="no" noresize="noresize" border="0" framespacing="0">
    <frame src="banner.php" name="topFrame" scrolling="no" noresize="noresize" id="topFrame" title="topFrame" />
    <frameset id="fraCorpo" rows="*" cols="220,*" framespacing="0" frameborder="no" border="0">
        <frame src="menu.php" name="leftFrame" scrolling="auto" noresize="noresize" id="leftFrame" />
        <frame src="formularios/acessoEscola.php" name="mainFrame" id="mainFrame" title="modulo" />
    </frameset></frameset>
</html>
