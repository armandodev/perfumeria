<?php
require_once './../session.php';

// Verifica si el usuario actual es un administrador
if (!isAdmin()) {
  // Redirecciona al directorio principal si el usuario no es un administrador
  header('Location: ./../');
  exit;
}
