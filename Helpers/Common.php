<?php

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\SMTP;

require_once "./Core/Model.php";
require_once "./Libs/PHPMailer/PHPMailer.php";
require_once "./Libs/PHPMailer/SMTP.php";
class Common extends Model
{

    static function getCategories()
    {
        $db = new static();
        $sql = "SELECT * FROM `tbl_product` WHERE `prod_available` = 1 AND `prod_parent_id` = 1";
        $db->query($sql);
        $result = $db->all();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    static function sendOtpMail($email, $otp)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vishalsinghsrm@outlook.com';
            $mail->Password = 'vioutlook@56';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('vishalsinghsrm@outlook.com', 'Vishal Singh');
            $mail->addAddress($email, "User");

            $mail->isHTML(true);
            $mail->Subject = 'Verify your email';
            $mail->Body = 'Your OTP for registration is:<h1 style="text-align: center">' . $otp . '</h1>';
            $mail->AltBody = '';
            return $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    static function sendOtpMobile($number, $otp)
    {
        $fields = array(
            "sender_id" => "FSTSMS",
            "message" => "OTP for registration is: " . $otp,
            "language" => "english",
            "route" => "p",
            "numbers" => $number,
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($fields),
            CURLOPT_HTTPHEADER => array(
                "authorization: sZMP0Ojrwpky3iSc6doX8g1LfUFG5zJBN7CtKeuWVIYv4DTmHnVHGa2yYJkwu56Xtn1CTLvNA7pg8sjS",
                "accept: */*",
                "cache-control: no-cache",
                "content-type: application/json"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return false;
        } else {
            return true;
        }
    }
}
