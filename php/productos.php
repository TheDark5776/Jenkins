<?php

// Clases
class producto {

  //Estados
  private $cod;
  private $descripcion;
  private $precio;
  private $stock;
  private $op;
  private $busqueda;

  //comportamientos
  function __construct($cod,$descripcion,$precio,$stock) {
    $this->cod = $cod;
    $this->descripcion = $descripcion;
    $this->precio = $precio;
    $this->stock = $stock;
  }

  function insertarProducto($conn){
    $sql = "INSERT INTO productos (cod, descripcion, precio, stock) VALUES ('".$this->cod."', '".$this->descripcion."', '".$this->precio."', '".$this->stock."');";
    if ($conn->query($sql) == true){
      echo "Nuevo registro insertado correctamente.";
    } else {
      echo "Error: ".$sql.$conn->error;
    }
  }

  function buscarProducto($busqueda,$op,$conn){
    $sql = "SELECT * FROM productos WHERE ";
    switch ($op) {
      case "cod":
        $sql = $sql."cod = $busqueda;";
        break;
      case "desc":
        $sql = $sql."descripcion like '%$busqueda%';";
        break;
      case "pre":
        $sql = $sql."precio <= $busqueda;";
	    break;
    
      default:
        echo "Se ha producido un error durante la búsqueda.";
    }

    $resultado = $conn->query($sql);

    if ($conn->query($sql) == true) {
      // Consulta para realizar la busqueda en la base de datos
      if ($resultado->num_rows > 0) {
        // Salida de datos por cada fila
        while ($row = $resultado->fetch_assoc()) {
          echo " <br> Codigo Producto : " . $row["cod"] . " <br> Descripcion: " . $row["descripcion"] . " <br> Precio: " . $row["precio"] . "<br> Stock : " . $row["stock"] . "<br>";
        }
      } else {
        echo "Hay 0 resultados";
      }
    } else {
      echo "Error: " . $sql . $conn->error;
    }
  }
}

?>