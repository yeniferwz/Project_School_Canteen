<?php
class menuModel extends Model
{
    public function getMenu(){
        $mysqli = $this->conn;
        $consulta=mysqli_query($mysqli, "SELECT * FROM PRODUCTE;");
            
        $menus=(object)['mati'=>[], 'tarda'=>[]];
        $horari="";
        $producte=[];

        while ($row=mysqli_fetch_array($consulta)) {
            $imatge="img/".$row['nomProducte'].".png";
            $quantitat=0;
            $producte=['id'=>$row['idProducte'], 'nom'=>$row['nomProducte'],'tipus'=>$row['tipus'],'preu'=>$row['preu'],'quantitat' => $quantitat,'UrlImg'=>$imatge, 'stock'=>$row['stock']];
            $horari=$row['horari'];
            
            //guarda els productes del horari corresponent a $menus
            if($horari=="mati" || $horari=="tots"){
                $menus->mati[]=(object)$producte;
            }
            if ($horari=="tarda" || $horari=="tots"){
                $menus->tarda[]=(object)$producte;
            }
        }

        header('Content-Type: application/json; charset=utf-8');

        return json_encode($menus);
    }

    //funcio per inserir dades al usuari
    public function insertUsuari($nom, $cognom, $correu, $telefon){
        error_log("---------------USER".$nom."  ".$cognom."  ".$correu."  ".$telefon."  ");
        $mysqli = $this->conn;
        $telefon=intval($telefon);
        mysqli_query($mysqli, "INSERT INTO USUARI (correu, nom, cognoms, telefon) VALUES ('$correu', '$nom', '$cognom', $telefon);");
    }

    //funcio per actualitzar stock amb les variables que li pasa per pas de parametre
    function actualitzarStock($idProducte, $quantitat){
        $mysqli = $this->conn;
        $sql = "UPDATE PRODUCTE SET PRODUCTE.stock = PRODUCTE.stock - $quantitat WHERE PRODUCTE.idProducte = $idProducte";
        mysqli_query($mysqli,$sql);
    }

    //funcio que agafa l'ultim idComanda de l'usuari i actualitza les dades del producte que hagi seleccionat
    public function insertComanda($productes, $correu){
        //include("./api/config.php");
        $mysqli = $this->conn;
        mysqli_query($mysqli, "INSERT INTO COMANDA (COMANDA.dataComanda, COMANDA.correu, COMANDA.fet) VALUES (now(), '$correu', FALSE);");

        $consulta=mysqli_query($mysqli, "SELECT MAX(idComanda) AS comandaActual FROM COMANDA");
        $res=mysqli_fetch_array($consulta);
        $idComanda=$res['comandaActual'];
        //var_dump($productes);
        $longitud=count($productes);
        for ($i=0; $i < $longitud; $i++) {
            $preu=floatval($productes[$i]->preu);
            $quantitat = $productes[$i]->quantitat;
            $preuTotal=($preu*$quantitat);
            $id_prod = $productes[$i]->id;
            mysqli_query($mysqli, "INSERT INTO LINIA_COMANDA (idProducte, idComanda, quantitat, preuUnitari, preuTotal) VALUES ($id_prod, $idComanda, $quantitat, $preu, $preuTotal);");
            $this->actualitzarStock($id_prod,$quantitat);
        }
        
        return $idComanda;
    }

    //funcio que comprova si existeix l'usuari
    public function comprovarUsuari($correu){
        $mysqli=$this->conn;
        $resultat=false;
        $consulta=mysqli_query($mysqli, "SELECT COUNT(USUARI.correu) AS resultat FROM USUARI WHERE USUARI.correu='$correu'");
        $row=mysqli_fetch_array($consulta);
        $r=$row['resultat'];
        if($r==0){
            $resultat=false;
        }else{
            $resultat=true;
        }
        return $resultat;
    }

    //funcio que comprova si s'ha fet la comanda en el dia corresponent
    public function comprovarDia($correu){
        $mysqli=$this->conn;
        $dataActual=date("Y-m-d");
        $consulta=mysqli_query($mysqli, "SELECT COUNT(COMANDA.idComanda) AS resultat FROM COMANDA WHERE COMANDA.correu='$correu' AND COMANDA.dataComanda='$dataActual'");
        $row=mysqli_fetch_array($consulta);
        $r=$row['resultat'];
        if($r==0){
            $resultat=false;
        }else{
            $resultat=true;
        }
        return $resultat;
    }

    //funcio que comprovi si la comanda ja esta feta o no
    public function estatComanda($correu){
        $mysqli=$this->conn;
        $dataActual=date("Y-m-d");
        $consulta=mysqli_query($mysqli, "SELECT COMANDA.fet FROM COMANDA WHERE COMANDA.correu='$correu' AND COMANDA.dataComanda='$dataActual'");
        $row=mysqli_fetch_array($consulta);
        $r=$row['fet'];
        if($r==0){
            $resultat=false;
        }else{
            $resultat=true;
        }
        return $resultat;
    }

    //funcio que comprovi si l'usuari s'hagi fet una comanda a un dia especific
    public function comprovarComandaDia($correu){
        $result=array();
        $dataActual=date("Y-m-d");
        $sql="SELECT COMANDA.idComanda FROM COMANDA WHERE COMANDA.correu='$correu' AND COMANDA.dataComanda='$dataActual'";
        $select = $this->conn->query($sql);
        if($select->num_rows > 0){
            $row = $select->fetch_assoc();
            $result= $row["idComanda"];
             //echo "id: " . $row["id"] . " - Name: " . $row["firstname"] . " " . $row["lastname"] . "<br>";
            
        }
        return $result;
    }

    public function estatComandaId($id){
        $mysqli=$this->conn;
        $sql=
        $consulta=mysqli_query($mysqli, "SELECT COMANDA.fet FROM COMANDA WHERE COMANDA.idComanda=$id");
        $row=mysqli_fetch_array($consulta);
        $r=$row['fet'];
        if($r==0){
            $resultat=false;
        }else{
            $resultat=true;
        }
        return $resultat;
    }

    public function enviarCorreu($nom, $cognom, $correu, $idComanda){
        $to="$correu";
        $from="cantina2@inspedralbes.cat";
        $subject="La teva comanda";
        $msg= "<html lang='ca'><head> <title>Cantina Institut Pedralbes</title> <style type='text/css'> body { margin: 0; padding: 0; } img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; } table { border-collapse: collapse !important; } body { height: 100% !important; margin: 0; padding: 0; width: 100% !important; } </style></head><body style='margin: 0; padding: 0;'> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'> <tr> <td bgcolor='#ffffff'> <div align='center' style='padding: 0px 15px 0px 15px;'> <table border='0' cellpadding='0' cellspacing='0' width='500' class='wrapper'> <tr> <td style='padding: 20px 0px 30px 0px;' class='logo'> <table border='0' cellpadding='0' cellspacing='0' width='100%'> <tr> <td bgcolor='#ffffff' width='100' align='left'><a href='http://cantina2.alumnes.inspedralbes.cat/' target='_blank'><img alt='Logo' src='http://cantina2.alumnes.inspedralbes.cat/img/LogoPedralbesIcon.png' width='52' height='78' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;' border='0'></a></td> <td bgcolor='#ffffff' width='400' align='right' class='mobile-hide'> <table border='0' cellpadding='0' cellspacing='0'> <tr> <td align='right' style='padding: 0 0 5px 0; font-size: 14px; font-family: Arial, sans-serif; color: #666666; text-decoration: none;'> <span style='color: #666666; text-decoration: none;'>Institut Pedralbes</span></td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </div> </td> </tr> </table> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'> <tr> <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'> <table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tbody> <tr> <td class='padding-copy'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td> <img src='http://cantina2.alumnes.inspedralbes.cat/img/food.jpg' width='50%' border='0' alt='Menjar' style='display: block; padding: 0; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; width: 500px; height: 350px;' class='img-max'> </td> </tr> </table> </td> </tr> </tbody> </table> </td> </tr> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>La teva comanda $idComanda</td> </tr> <tr> <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Hola $nom $cognom, gràcies per comprar a la cantina! <br> Ja hem rebut la teva comanda i aviat ens posarem mans a l'obra.<br><br>Recorda que el teu número de comanda és el $idComanda. <br>Rebràs un altre correu quan la teva comanda estigui llesta.</td> </tr> </table> </td> </tr> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0' class='mobile-button-container'> <tr> <td align='center' style='padding: 25px 0 0 0;' class='padding-copy'> <table border='0' cellspacing='0' cellpadding='0' class='responsive-table'> <tr> <td align='center'><a href='http://cantina2.alumnes.inspedralbes.cat/' target='_blank' style='font-size: 16px; font-family: Helvetica, Arial, sans-serif; font-weight: normal; color: #ffffff; text-decoration: none; background-color: #5D9CEC; border-top: 15px solid #5D9CEC; border-bottom: 15px solid #5D9CEC; border-left: 25px solid #5D9CEC; border-right: 25px solid #5D9CEC; border-radius: 3px; -webkit-border-radius: 3px; -moz-border-radius: 3px; display: inline-block;' class='mobile-button'>Edita la comanda &rarr;</a> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> <table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'> <tr> <td bgcolor='#ffffff' align='center'> <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'> <tr> <td style='padding: 20px 0px 20px 0px;'> <table width='500' border='0' cellspacing='0' cellpadding='0' align='center' class='responsive-table'> <tr> <td align='center' valign='middle' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'> <span class='appleFooter' style='color:#666666;'>Av. Esplugues, 36-42. 08034. Barcelona</span><br><a class='original-only' style='color: #666666; text-decoration: none;'>Cantina</a><span class='original-only' style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style='color: #666666; text-decoration: none;'>Institut Pedralbes</a> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table></body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        $headers .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        mail($to,$subject,$msg, $headers);        
    }
}

