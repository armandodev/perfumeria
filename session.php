<?php
session_start();

function isLogged()
{
  return isset($_SESSION['usuario']); // Verifica si el usuario ha iniciado sesión
}

function isAdmin()
{
  return isLogged() && $_SESSION['usuario']['rol'] == 'admin'; // Verifica si el usuario ha iniciado sesión y si su rol es 'admin'
}
