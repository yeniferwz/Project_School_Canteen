<?php
class comandaModel extends Model
{
    //funcio que mostra les comandes fetes per data 
    public function getComandas(){
        $result=array();
        $data=getdate();
        $dt=$data['year']."-".$data['mon']."-".$data['mday'];
        $sql="SELECT * FROM COMANDA WHERE dataComanda='".$dt."' ORDER BY COMANDA.fet, COMANDA.idComanda DESC;";
        $select = $this->conn->query($sql);
        if($select->num_rows > 0){
            while ($row = $select->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
    }

    //funcio que canvi l'estat de la comanda quan admin ho marca per fet
    public function marcarComanda($id){
        $sql="SELECT * FROM COMANDA WHERE idComanda=".$id.";";
        $select = $this->conn->query($sql);
        $act=0;
        if($select->num_rows > 0){
           if($row = $select->fetch_assoc()) {
                $result[] = $row;
                $act=$row["fet"];
                $correu=$row["correu"];
            }
        }
        if($act==0){
            $upd=1;
        }else{
            $upd=0;
        }
        error_log( "!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!act ".$act."   upd ".$upd);
        $sql="UPDATE COMANDA SET fet=".$upd." WHERE idComanda=".$id.";";
        $this->conn->query($sql);
        $this->enviarCorreuFet($correu, $id);

        return "done";
    }

    //funcio que mostra les comandes per id (id que li passi per pas de parametre)
    public function infoComanda($id){
        $result=array();
        $sql="SELECT * FROM LINIA_COMANDA WHERE idComanda='".$id."';";
        $select = $this->conn->query($sql);
        if($select->num_rows > 0){
            while ($row = $select->fetch_assoc()) {
                $result[] = $row;
            }
        }
        return $result;
        
    }

    //funcio que mostra tota la infomacio dels productes
    public function infoProductes($productes){
        $result=array();
        for ($i=0; $i < count($productes); $i++) {
            $sql="SELECT * FROM PRODUCTE WHERE idProducte='".$productes[$i]['idProducte']."';";
            $select = $this->conn->query($sql);
            if($select->num_rows > 0){
                while($row = $select->fetch_assoc()) {
                    $result[]=$row;
                }
            }
        }
        return $result;
    }

    //funcio que actualitza l'estat de la comanda, actualitza tambe l'estoc que s'hagi comprat algun producte
    public function updateComanda($idComanda,$productes){
        $mysqli=$this->conn;
        $sql="SELECT idProducte, quantitat FROM LINIA_COMANDA WHERE idComanda=$idComanda;";
        $select=$mysqli->query($sql);
        if($select->num_rows > 0){
            while($row = $select->fetch_assoc()) {
                $this->sumarStock($row['idProducte'],$row['quantitat']);
            }
        }

        $query = "DELETE FROM LINIA_COMANDA WHERE idComanda=$idComanda;";
        mysqli_query($mysqli,$query);
        $longitud=count($productes);

        for ($i=0; $i < $longitud; $i++) {
            $preu=floatval($productes[$i]->preu);
            $quantitat = $productes[$i]->quantitat;
            $preuTotal=($preu*$quantitat);
            $id_prod = $productes[$i]->id;
            mysqli_query($this->conn, "INSERT INTO LINIA_COMANDA (idProducte, idComanda, quantitat, preuUnitari, preuTotal) VALUES ($id_prod, $idComanda, $quantitat, $preu, $preuTotal);");
            $this->actualitzarStock($id_prod,$quantitat);
        }

        return $idComanda;
    }

    //funcio per actualitzar stock
    public function actualitzarStock($idProducte, $quantitat){
        $mysqli = $this->conn;
        $sql = "UPDATE PRODUCTE SET PRODUCTE.stock = PRODUCTE.stock - $quantitat WHERE PRODUCTE.idProducte = $idProducte";
        mysqli_query($mysqli,$sql);
    }

    //funcio per sumar stocks que te un producte
    public function sumarStock($idProducte, $quantitat){
        $mysqli = $this->conn;
        $sql = "UPDATE PRODUCTE SET PRODUCTE.stock = PRODUCTE.stock + $quantitat WHERE PRODUCTE.idProducte = $idProducte";
        mysqli_query($mysqli,$sql);
    }

    //funcio que s'envia un correo a l'usuari per fer un recordatori de comanda
    public function enviarCorreuFet($correu, $idComanda){
        $to="$correu";
        $from="cantina2@inspedralbes.cat";
        $subject="Recull la teva comanda";
        $msg= "<html lang='ca'><head><title>Cantina Institut Pedralbes</title><style type='text/css'> body{margin:0; padding:0;} img{border:0; height:auto; line-height:100%; outline:none; text-decoration:none;} table{border-collapse:collapse !important;} body{height:100% !important; margin:0; padding:0; width:100% !important;}</style></head><body style='margin: 0; padding: 0;'><table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'> <tr> <td bgcolor='#ffffff'> <div align='center' style='padding: 0px 15px 0px 15px;'> <table border='0' cellpadding='0' cellspacing='0' width='500' class='wrapper'> <tr> <td style='padding: 20px 0px 30px 0px;' class='logo'> <table border='0' cellpadding='0' cellspacing='0' width='100%'> <tr> <td bgcolor='#ffffff' width='100' align='left'><a href='http://cantina2.alumnes.inspedralbes.cat/' target='_blank'><img alt='Logo' src='http://cantina2.alumnes.inspedralbes.cat/img/LogoPedralbesIcon.png' width='52' height='78' style='display: block; font-family: Helvetica, Arial, sans-serif; color: #666666; font-size: 16px;' border='0'></a></td> <td bgcolor='#ffffff' width='400' align='right' class='mobile-hide'> <table border='0' cellpadding='0' cellspacing='0'> <tr> <td align='right' style='padding: 0 0 5px 0; font-size: 14px; font-family: Arial, sans-serif; color: #666666; text-decoration: none;'><span style='color: #666666; text-decoration: none;'>Institut Pedralbes</span></td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </div> </td> </tr></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'> <tr> <td bgcolor='#ffffff' align='center' style='padding: 70px 15px 70px 15px;' class='section-padding'> <table border='0' cellpadding='0' cellspacing='0' width='500' class='responsive-table'> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tbody> <tr> <td class='padding-copy'> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td> <img src='http://cantina2.alumnes.inspedralbes.cat/img/valida.png' width='50%' border='0' alt='Menjar' style='display: block; padding: 0; color: #666666; text-decoration: none; font-family: Helvetica, arial, sans-serif; font-size: 16px; width: 500px; height: 450px;' class='img-max'> </td> </tr> </table> </td> </tr> </tbody> </table> </td> </tr> <tr> <td> <table width='100%' border='0' cellspacing='0' cellpadding='0'> <tr> <td align='center' style='font-size: 25px; font-family: Helvetica, Arial, sans-serif; color: #333333; padding-top: 30px;' class='padding-copy'>Comanda llesta!</td> </tr> <tr> <td align='center' style='padding: 20px 0 0 0; font-size: 16px; line-height: 25px; font-family: Helvetica, Arial, sans-serif; color: #666666;' class='padding-copy'>Ja tenim la teva comanda (amb número $idComanda) a punt, passa't per la cantina per recollir-la!<br><br>Recorda que hauràs de mostrar el teu número de comanda.</td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr></table><table border='0' cellpadding='0' cellspacing='0' width='100%' style='table-layout: fixed;'> <tr> <td bgcolor='#ffffff' align='center'> <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'> <tr> <td style='padding: 20px 0px 20px 0px;'> <table width='500' border='0' cellspacing='0' cellpadding='0' align='center' class='responsive-table'> <tr> <td align='center' valign='middle' style='font-size: 12px; line-height: 18px; font-family: Helvetica, Arial, sans-serif; color:#666666;'> <span class='appleFooter' style='color:#666666;'>Av. Esplugues, 36-42. 08034. Barcelona</span><br><a class='original-only' style='color: #666666; text-decoration: none;'>Cantina</a><span class='original-only' style='font-family: Arial, sans-serif; font-size: 12px; color: #444444;'>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span><a style='color: #666666; text-decoration: none;'>Institut Pedralbes</a> </td> </tr> </table> </td> </tr> </table> </td> </tr></table></body></html>";
        $headers = "MIME-Version: 1.0" . "\r\n"; 
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
        $headers .= 'From: '.$from."\r\n".
                    'Reply-To: '.$from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
        mail($to,$subject,$msg, $headers);  
    }
}
