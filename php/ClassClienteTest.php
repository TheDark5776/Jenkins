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
require 'cliente.php';

class ClienteTest extends \PHPUnit\Framework\TestCase
{


    public function testdarAlta()
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
        $sqlPrueba = "select * from clientes;";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $clientesAntes = $resultado->num_rows;


        $clienteNuevo = new Cliente("prueba222", "prueba", "prueba", "miassda@gmail.com", "2023-03-04");

        $clienteNuevo->darAlta($conn);

        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $clientesDespues = $resultado->num_rows;


        $this->assertEquals($clientesAntes + 1, $clientesDespues, "El cliente se da de alta correctamente");

        //Segunda tanda
        $sqlPrueba = "select * from clientes where DNI like 'prueba4';";
        $resultado = $conn->query($sqlPrueba);

        // Consulta para realizar la busqueda en la base de datos
        $numeroFilas = $resultado->num_rows;

        $this->assertEquals(1, $numeroFilas, "El cliente se da de alta correctamente, 2a prueba, y no se repiten filas");

        $conn->close();


    }
    public function testbuscarCliente()
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


        $buscador = new Cliente("1","1","1","1","1");



        //lanzo una peticion cliente->buscar("Ped","onom",$conn) que tiene que ser resultado == 1
        $resultado = $buscador->buscarCliente("Pedro","nom",$conn);
        $this->assertEquals(null,$resultado,"Hemos buscado a Pedro y no estaba???");
    }
    
}

