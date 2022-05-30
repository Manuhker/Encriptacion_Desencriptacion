<?php
$conn = new mysqli("localhost","root","","loginval");

if($conn ->connect.errno){
    echo "No hay conexión: (".$conn->connect_errno.")".$conn->connect.error;
}

$nombre = $_POST['textusuario'];
$pass = $_POST['textpassword'];

if(isset($_POST['btn_registrar'])){
    $pass_fuerte = password_hash($pass, PASSWORD_DEFAULT);
    $queryregistrar = "INSERT INTO login(usu,pass) values ('$nombre','$pass_fuerte')";
if(mysqli_query($conn, $queryregistrar)){
    echo "<script>alert('Usuario registrado: $nombre' 'Contraseña encriptada');window.location='Index.html'</script>";
}else{
    echo"Error: ".$queryregistrar."<br>".msyql_error($conn);
}
}

if(isset($_POST['btn_desencriptar'])){
    $queryrusuario = mysqli_query($conn, "SELECT * FROM login WHERE usu = '$nombre'");
    $nr = mysqli_num_rows($queryrusuario);
    $findpass = mysqli_fetch_array($queryrusuario);
    if($nr == 1 && (password_verify($pass,$findpass['pass']))){
        echo "Bienvenido: $nombre";
    }else{
        echo "<script>alert('Usuario o contraseña incorrecto');window.location='Index.html'</script>";
    }

}

?>