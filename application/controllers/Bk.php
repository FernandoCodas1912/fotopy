<?php
error_reporting(E_ALL);
//require("application/libraries/PHPMailer/PHPMailerAutoload.php");
ini_set("memory_limit", "128M");

// Set script max execution time
set_time_limit(900); // 15 minutes

class Bk extends CI_Controller
{
    public function index()
    {

        $this->load->helper('url');
        $this->load->helper('file');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->load->dbutil();
        $db_format = array(
            'format' => 'zip',
            'filename' => $this->db->database,
        );
        $backup = $this->dbutil->backup($db_format);

        $dbname = $this->db->database . '_' . date('Y-m-d') . '.zip';
        $save = 'Bd_Backup/' . $dbname;
        write_file($save, $backup);
        //    redirect('Dashboard_controller');


        // //Este bloque es importante
        // $date = date('d/m/Y');
        // $m = new PHPMailer();
        // $m->IsSMTP();
        // //  $m->SMTPDebug = 2;

        // $m->SMTPAuth = true;
        // $m->Username = 'soportegescob@gmail.com';
        // $m->Password = 'Soporte123';
        // $m->FromName = 'Copia de Seguridad Sistema Gestock del ' . $date;
        // $m->Host = "smtp.gmail.com";
        // $m->SMTPSecure = "tls"; //tls o ssl
        // $m->Port = 587;
        // //   $filesize = number_format(filesize($backup) / 1048576, 0);
        // $m->AddAddress('soportegescob@gmail.com');
        // //$m->AddCC('eruizpy@gmail.com', 'Esteban');
        // // $m->AddCC('acmtaller@gmail.com', 'ACM Taller');
        // $m->addAttachment('Bd_Backup/' . $dbname);
        // $m->Subject = "Copia de Seguridad de  " . $this->db->database;
        // $m->MsgHTML(nl2br("La copia del Seguridad del  ${date} es adjuntado a este correo "));
        // if ($m->Send()) {
        //     redirect('dashboard');
        // } else {
        //     echo "Error, could not send: {$m->ErrorInfo}";
        // }

        // //   force_download($dbname, $backup);



    }
}