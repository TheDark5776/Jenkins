<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
class Cliente {
    //Estado
    private $DNI;
    private $nombre;
    private $apellidos;
    private $email;
    private $fecha_nacimiento;

    //Comportamiento
    function __construct($DNI,$nombre,$apellidos,$email,$fecha_nacimiento) {
        $this->DNI = $DNI;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->fecha_nacimiento = $fecha_nacimiento;
    }

    //darse de alta
    function darAlta($conn) {
$sql = "INSERT INTO clientes (DNI,nombre,apellidos,email,fecha_nacimiento) VALUES ('$this->DNI','$this->nombre','$this->apellidos','$this->email','$this->fecha_nacimiento');"; 
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
            //hago la construccion del email y lo mando
            // Load Composer's autoloader


            // Instantiation and passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'grupo5s21ar@gmail.com';                     // SMTP username
                $mail->Password   = 'bolson32';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                //Recipients
                $mail->setFrom('grupo5s21ar@gmail.com', 'Mailer');
                $mail->addAddress("$this->email");     // Add a recipient              
                $mail->addReplyTo('grupo5s21ar@gmail.com', 'Information');
                $mail->addCC('grupo5s21ar@gmail.com');
                $mail->addBCC('grupo5s21ar@gmail.com');

                // Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = 'Te registraste en nuestra TiendaWeb2.0';
                $mail->Body    = 'Felicidades, te uniste a la tienda mas cañera del <b> mundo </b>';
                $mail->AltBody = 'xD';
                $mail->send();
                echo 'Mensaje enviado';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        
    
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }

    function buscarCliente($busqueda,$op,$conn){

                // Consulta para realizar la búsqueda en la base de datos
        $sql = "SELECT * FROM clientes WHERE ";
        switch ($op){
          case "DNI":
            $sql = $sql."DNI like '%$busqueda%';";
          break;
          case "nom":
            $sql = $sql."nombre like '%$busqueda%';";
          break;
          case "apell":
            $sql = $sql."apellidos like '%$busqueda%';";
          break;
          case "email":
            $sql = $sql."email like '%$busqueda%';";
          break;
        
          default:
            echo "Se ha producido un error durante la búsqueda.";
        }

        $resultado = mysqli_query($conn, $sql);

        // Consulta para realizar la busqueda en la base de datos
        if (mysqli_num_rows($resultado) > 0) {
          // Salida de datos por cada fila
          while($row = mysqli_fetch_assoc($resultado)) {
            echo "  <br> DNI: " . $row["DNI"] . " <br> Nombre : " . $row["nombre"] . " <br> Apellido: " . $row["apellidos"] . " <br> Email : " . $row["email"] . "<br> Fecha : " . $row["fecha_nacimiento"] . "<br>";
          }
        }else{
          return null;
        }



    }
    


   }
?>
