<?php
if ($_SERVER['REQUEST_URI'] != URI) {
    if ($_SESSION) {
      echo '<input type="hidden" id="rol" value=' . $_SESSION['rol'] . '>';
      echo '<input type="hidden" id="usuario" value=' . $_SESSION['id_cliente'] . '>';
      echo '<input type="hidden" id="link" value='.URL_APP.'>';
    } else {
      header("Location: ./");
      die();
    } 
  } else {
    if ($_SESSION) {  
      echo '<input type="hidden" id="rol" value=' . $_SESSION['rol'] . '>';
      echo '<input type="hidden" id="usuario" value=' . $_SESSION['id_cliente'] . '>';
      echo '<input type="hidden" id="link" value='.URL_APP.'>';
    }
  }