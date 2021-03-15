<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SalarioTest
 *
 * @author -andrés
 */

require 'vendor/autoload.php';
require 'productos.php';
class productoTest extends \PHPUnit\Framework\TestCase {

    public function testinsertarProducto() 
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }


        //Primera tanda
        //Primero calculo cuantas lineas hay en la tabla
        $sqlPrueba = "select * from productos;";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $producto_Antes = $resultado->num_rows;


        $producto_Nuevo = new producto("9", "prba", "1", "1");

        $producto_Nuevo->insertarProducto($conn);

        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $producto_Despues = $resultado->num_rows;


        $this->assertEquals($producto_Antes + 1, $producto_Despues, "El producto ha sido insertado correctamente");

        //Segunda tanda
        $sqlPrueba = "select * from productos where cod like 'cod';";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $numero_Filas = $resultado->num_rows;

        $this->assertEquals(null, $numero_Filas, "El producto se inserta correctamente, 2a prueba, y no se repiten filas");

        $conn->close();
    }
    public function testbuscarProducto()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        //primero inserto 5 filas en la tabla

        //creo un objeto Cliente, y le pongo valores al azar como en el código real


        $buscador = new producto("1","1","1","1");



        //lanzo una peticion cliente->buscar("Ped","onom",$conn) que tiene que ser resultado == 1
        $resultado = $buscador->buscarProducto("1","cod",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado un producto, su codigo era 1 y no estaba");
    }
    public function testbuscarPrecio()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        //primero inserto 5 filas en la tabla

        //creo un objeto Cliente, y le pongo valores al azar como en el código real


        $buscador = new producto("1","1","1","1");



        //lanzo una peticion cliente->buscar("Ped","onom",$conn) que tiene que ser resultado == 1
        $resultado = $buscador->buscarProducto("1","pre",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado un precio cuyo valor era 1 y no estaba");
    }
    public function testbuscardescripcion()
    {

        $servername = "localhost";
        $username = "php";
        $password = "1234";
        $dbname = "pruebas";

        // Establecer conexión con la base de datos
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        //primero inserto 5 filas en la tabla

        //creo un objeto Cliente, y le pongo valores al azar como en el código real


        $buscador = new producto("1","1","1","1");



        //lanzo una peticion cliente->buscar("Ped","onom",$conn) que tiene que ser resultado == 1
        $resultado = $buscador->buscarProducto("1","desc",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado un producto que tuviese 1 de descripcion y no habia");
    }
}