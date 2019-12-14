<?php
require 'Database.php';

class DbFunction
{

    public function login($loginid, $password)
    {

        if (!ctype_alpha($loginid) || !ctype_alpha($password)) {

            echo "<script>alert('Either LoginId or Password is Missing')</script>";

        } else {
            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = "SELECT loginid, password FROM tbl_login where loginid=? and password=? ";
            $stmt = $mysqli->prepare($query);
            if (false === $stmt) {

                trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
            } else {

                $stmt->bind_param('ss', $loginid, $password);
                $stmt->execute();
                $stmt->bind_result($loginid, $password);
                $rs = $stmt->fetch();
                if (!$rs) {
                    echo "<script>alert('Invalid Details')</script>";
                    header('location:login.php');
                } else {

                    header('location:view.php');
                }
            }

        }

    }

    public function showCountry()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM countries ";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

    public function getPaymentScheduleById($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM paymentdates where id ='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

    public function getDue($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM due  where booking_id='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

//get total packages and due amount
    public function getTotalPackageAmount()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT SUM(Package) as Package,SUM(Paid) as Paid,SUM(totalDue) as totalDue,SUM(dueTillToday) as dueTillToday FROM due";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

//write function for update due payments and payment_details
    public function store_payment_due_details($id, $amount, $status, $dates)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $myObj2 = $this->createJson($status[0], $status[1], $status[2], $status[3], $status[4], $status[5], $status[6], $status[7], $status[8], $status[9], $status[10], $status[11], $status[12], $status[13]);
        $myJSON2 = json_encode($myObj2);
        $datesArray = array();
        $i = 0;
        foreach ($dates as $data) {
            $datesArray[$i] = $data; // echo's 'test1test2test3'
            $i++;
        }
        $paymentDatesCurrent = array();
        foreach ($status as $key => $value) {
            if ((strcmp($value, "True") == 0) && empty($datesArray[$key])) {
                $paymentDatesCurrent[$key] = date("Y-m-d");
            } elseif ((strcmp($value, "True") == 0) && !empty($datesArray[$key])) {
                $paymentDatesCurrent[$key] = $datesArray[$key];
            } else {
                $paymentDatesCurrent[$key] = "";
            }
        }
        $myObj3 = $this->createJson($paymentDatesCurrent[0], $paymentDatesCurrent[1], $paymentDatesCurrent[2], $paymentDatesCurrent[3], $paymentDatesCurrent[4], $paymentDatesCurrent[5], $paymentDatesCurrent[6], $paymentDatesCurrent[7], $paymentDatesCurrent[8], $paymentDatesCurrent[9], $paymentDatesCurrent[10], $paymentDatesCurrent[11], $paymentDatesCurrent[12], $paymentDatesCurrent[13]);
        $myJSON3 = json_encode($myObj3);
        $query = "UPDATE `payment_datails` set payment_status=?, paymentDate=? where booking_id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('ssi', $myJSON2, $myJSON3, $id);
        // var_dump($myJSON2);
        $stmt->execute();
        $rs = $this->getPaymentDetails($id);
        $res = $rs->fetch_object();
        $this->updateDueAmountBydate($id, $res);
        return $this->showPayment($id);
    }

//write function to update all users
    public function updateDueOfAllUser()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT amount,payment_status,package_amount,booking_id FROM payment_datails";
        //echo date('Y-m-d H-i-s');
        $stmt = $mysqli->query($query);
        while ($res = $stmt->fetch_object()) {
            $this->updateDueAmountBydate($res->booking_id);
        }
    }

    public function createJson($d1, $d2, $d3, $d4, $d5, $d6, $d7, $d8, $d9, $d10, $d11, $d12, $d13, $d14)
    {
        $myObj = array("key1" => $d1, "key2" => $d2, "key3" => $d3, "key4" => $d4,
            "key5" => $d5, "key6" => $d6, "key7" => $d7, "key8" => $d8,
            "key9" => $d9, "key10" => $d10, "key11" => $d11, "key12" => $d12,
            "key13" => $d13, "key14" => $d14);
        return $myObj;
    }

//  function create_payment_Details($booking_id) {
    //     $db = Database::getInstance();
    //     $mysqli = $db->getConnection();
    //     $myObj = array();
    //     $myJSON = serialize($myObj);
    //     $myObj1 = $this-> createJson("","","","","","","","","","","","","","");
    //     $myJSON1 = json_encode($myObj1);
    //     $myObj2 = $this-> createJson(0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0);
    //     $myJSON2 = json_encode($myObj2);
    //     $myObj3 = $this-> createJson('False','False','False','False','False','False','False','False','False','False','False','False','False','False');
    //     $myJSON3 = json_encode($myObj3);
    //     $myObj4 = $this-> createJson(null,null,null,null,null,null,null,null,null,null,null,null,null,null);
    //     $myJSON4 = json_encode($myObj4);
    //     $query = "INSERT INTO `payment_datails` (`amount`,`payment_status`,`booking_id`,`paymentDate`,`payment`,`pendingPayment`) VALUES(?,?,?,?,?,?)";
    //     $stmt= $mysqli->prepare($query);
    //     if(false===$stmt){
    //          trigger_error("Error in query: " . mysqli_connect_error(),E_USER_ERROR);
    //     }else{
    //         $stmt->bind_param('ssiss',$myJSON2,$myJSON3,$booking_id,$myJSON1,$myJSON);
    //         $stmt->execute();
    //     }

// }
    public function createDueRow($booking_id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "INSERT INTO `due` (`Package`,`Paid`,`totalDue`,`DueTillToday`,`booking_id`) VALUES(?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $zero = 0;
            $stmt->bind_param('iiiii', $zero, $zero, $zero, $zero, $booking_id);
            $stmt->execute();
        }
    }

// function getPaymentSchedule(){
    //     $db = Database::getInstance();
    //     $mysqli = $db->getConnection();
    //     $query = "SELECT * FROM paymentdates ";
    //     $stmt= $mysqli->query($query);
    //     return $stmt;
    // }

    public function savePaymentSchedule($date, $schedule)
    {
        foreach ($date as $key => $value) {
            $date = date_format(date_create($value), 'Y-m-d');
            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = 'UPDATE  `paymentdates` set paymentDate = ?, payment_schedule=? where id= ?';
            $id = ($key + 1);
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('ssi', $date, $schedule[$key], $id);
            $stmt->execute();
        }
        $this->updateDueOfAllUser();

    }

// function showPayment($id){
    //     $db = Database::getInstance();
    //     $mysqli = $db->getConnection();
    //     $query = "SELECT * FROM payment_datails  where booking_id='".$id."'";
    //     $stmt= $mysqli->query($query);
    //     return $stmt;
    // }

    public function sendMail($to, $subject, $body)
    {
        require_once "Mail.php";
        // global $error;
        // $from_name = 'abhi'
        //    $mail = new PHPMailer();  // create a new object
        //    $mail->IsSMTP(); // enable SMTP
        //    $mail->SMTPDebug = 2;  // debugging: 1 = errors and messages, 2 = messages only
        //    $mail->SMTPAuth = true;  // authentication enabled
        //    $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        //    $mail->SMTPAutoTLS = false;
        //    $mail->Host = 'smtp.gmail.com';
        //    $mail->Port = 587;

        //    $mail->Username = 'abhijeet.r.more@gmail.com';
        //    $mail->Password = 'Gofw@1323';
        //    $mail->SetFrom($from, $from_name);
        //    $mail->Subject = $subject;
        //    $mail->Body = $body;
        //    $mail->AddAddress($to);
        //    if(!$mail->Send()) {
        //        $error = 'Mail error: '.$mail->ErrorInfo;
        //        return false;
        //    } else {
        //        $error = 'Message sent!';
        //        return true;
        //    }

        $from = '<abhijeet.r.more@gmail.com>';
        $to = '<' . $to . '>';
        $subject = $subject;
        $body = $body;
        var_dump($from, $to, $subject);
        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject,
        );

        $smtp = Mail::factory('smtp', array(
            'host' => 'smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'abhijeet.r.more@gmail.com',
            'password' => 'Gofw@1323',
        ));

        $mail = $smtp->send($to, $headers, $body);
        var_dump($from, $to, $subject);
        if (PEAR::isError($mail)) {
            echo ('<p>' . $mail->getMessage() . '</p>fhggjgk');
        } else {
        }
    }

//view.php
    public function del_std($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "delete from registration where id=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        echo "<script>alert('One record has been deleted')</script>";
        echo "<script>window.location.href='view-course.php'</script>";
    }

//show all registration
    public function showStudents()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM registration ";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

//register.php
    public function register($fname, $mname, $lname, $ocp, $gender, $company, $designation, $mobno, $email, $country, $state, $city, $padd, $cadd, $interestedIn, $budget, $loanSanctioned, $loanAmount,
        $bank, $reference) {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "INSERT INTO `registration` (`fname`, `mname`, `lname`,`ocp`,`gender`,`company`,`designation`,`mobno`, `emailid`, `country`, `state`, `dist`,`padd`, `cadd`, `interestedIn`, `budget`,`loanSanctioned`,`loanAmount`,`bank`,`reference`)
                    VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $reg = rand();
        $stmt = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param('ssssssssssssssssssss',
                $fname, $mname, $lname, $ocp, $gender, $company, $designation, $mobno, $email, $country, $state, $city, $padd, $cadd, $interestedIn, $budget, $loanSanctioned, $loanAmount, $bank, $reference);
            $stmt->execute();
            echo "<script>alert('Successfully Registered , your registration number is')</script>";
            header('location:view.php');
        }

    }

//edit-std.php
    //get user for update registration
    public function showStudents1($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM registration  where id='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

//update registration
    public function edit_std($fname, $mname, $lname, $ocp, $gender, $company, $designation, $mobno, $email, $country, $state, $city, $padd, $cadd, $interestedIn, $budget, $loanSanctioned, $loanAmount, $bank, $reference, $id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "update registration set fname=?,mname=?,lname=?,ocp=?,gender=?,company=?,designation=?
              ,mobno=?,emailid=?,country=?,state=?,dist=?
              ,padd=?,cadd=?,interestedIn=?,budget=?,loanSanctioned=?,loanAmount=?,bank=?,reference=? where id=?";

        $stmt = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        }
        $rc = $stmt->bind_param('sssssssssssssssssssss',
            $fname, $mname, $lname, $ocp, $gender, $company, $designation, $mobno, $email, $country, $state, $city, $padd, $cadd, $interestedIn, $budget, $loanSanctioned, $loanAmount, $bank, $reference, $id);
        if (false === $rc) {
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        $rc = $stmt->execute();
        if (false == $rc) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        } else {
            echo '<script>';
            echo 'alert(" Successfully Updated")';
            echo '</script>';
        }
    }

//booking.php

    public function searchUserFromReg($search)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM registration where mobno='" . $search . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

    public function booking($fname1, $mname1, $lname1, $age1, $ocp1, $pan1, $adhaar1, $mobno1, $amobno1, $email1, $padd1, $fname2, $mname2, $lname2, $age2, $ocp2, $pan2, $adhaar2, $mobno2, $amobno2, $email2, $padd2, $project, $wing, $config, $configNo, $floor, $area, $carpetArea, $balconyArea, $terraceArea, $parking, $parkingType)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "INSERT INTO `booking` (`B_id`,`fname1`,`mname1`,`lname1`,`age1`,`ocp1`,`pan1`,`adhaar1`,`mobno1`,`amobno1`, `email1`, `padd1`,`fname2`,`mname2`,`lname2`,`age2`,`ocp2`,`pan2`,`adhaar2`,`mobno2`, `amobno2`,`email2`,`padd2`,`project`,`wing`,`config`,`configNo`,`floor`,`area`,`carpetArea`,`balconyArea`,`terraceArea`,`parking`,`parkingType`) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $reg = rand();
        $stmt = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param('isssssssssssssssssssssssssssssssss', $reg,
                $fname1, $mname1, $lname1, $age1, $ocp1, $pan1, $adhaar1, $mobno1, $amobno1, $email1, $padd1, $fname2, $mname2, $lname2, $age2, $ocp2, $pan2, $adhaar2, $mobno2, $amobno2, $email2, $padd2, $project, $wing, $config, $configNo, $floor, $area, $carpetArea, $balconyArea, $terraceArea, $parking, $parkingType);
            $stmt->execute();
            header('location:payment.php?id=' . $reg);
            $this->create_payment_Details($reg);
            $this->createDueRow($reg);
        }
    }

//edit-Booking.php
    public function edit_booking($fname1, $mname1, $lname1, $age1, $ocp1, $pan1, $adhaar1, $mobno1, $amobno1, $email1, $padd1, $fname2, $mname2, $lname2, $age2, $ocp2, $pan2, $adhaar2, $mobno2, $amobno2, $email2, $padd2, $project, $wing, $config, $configNo, $floor, $area, $carpetArea, $balconyArea, $terraceArea, $parking, $parkingType, $B_id)
    {

        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "update booking set fname1=?,mname1=?,lname1=?,age1=?,ocp1=?,pan1=?,adhaar1=?,mobno1=?,amobno1=?,email1=?,padd1=?,fname2=?,mname2=?,lname2=?,age2=?,ocp2=?,pan2=?,adhaar2=?,mobno2=?,amobno2=?,email2=?,padd2=?,project=?,wing=?,config=?,configNo=?,floor=?,area=?,carpetArea=?,balconyArea=?,terraceArea=?,parking=?,parkingType=? where B_id=?";

        $stmt = $mysqli->prepare($query);
        if (false === $stmt) {

            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        }

        $rc = $stmt->bind_param('ssssssssssssssssssssssssssssssssss',
            $fname1, $mname1, $lname1, $age1, $ocp1, $pan1, $adhaar1, $mobno1, $amobno1, $email1, $padd1, $fname2, $mname2, $lname2, $age2, $ocp2, $pan2, $adhaar2, $mobno2, $amobno2, $email2, $padd2, $project, $wing, $config, $configNo, $floor, $area, $carpetArea, $balconyArea, $terraceArea, $parking, $parkingType, $B_id);

        if (false === $rc) {

            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        $rc = $stmt->execute();

        if (false == $rc) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        } else {
            echo '<script>';
            echo 'alert(" Successfully Updated")';
            echo '</script>';
        }

    }

//showBooking1.php
    public function showBooking1($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM booking  where B_id='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

//ViewBooking.php

    public function showBooking()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM booking ";
        $stmt = $mysqli->query($query);
        return $stmt;

    }

    public function del_Booking($B_id)
    {
        header('location:modal.php?id=' . $B_id);
    }

//modal.php
    public function validateUserForDelete($B_id, $loginid, $password)
    {
        if ($loginid === "admin" && $password === "admin") {
            $db = Database::getInstance();
            $mysqli = $db->getConnection();
            $query = "delete from booking where B_id=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('i', $B_id);
            $stmt->execute();
            echo "<script>alert('One record has been deleted')</script>";
            echo "<script>window.location.href='viewBooking.php'</script>";
        } else {
            echo "<script>alert('UserName and password is incorrect')</script>";
            echo "<script>window.location.href='viewBooking.php'</script>";
        }
    }

//Payment.php methods start here

//Gets all Payment Details here from payment_datails table
    public function showPayment($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM payment_datails  where booking_id='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }

//Creates Payment Details
    public function create_payment_Details($booking_id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $paymentReceivedArray = array();
        $paymentReceivedJSON = serialize($paymentReceivedArray);
        $paymentdates = $this->createJson("", "", "", "", "", "", "", "", "", "", "", "", "", "");
        $paymentdatesJSON = json_encode($paymentdates);
        $amountByPercentage = $this->createJson(0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
        $amountByPercentageJSON = json_encode($amountByPercentage);
        $totalPendingAmountByPercentage = $this->createJson(0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
        $totalPendingAmountByPercentageJSON = json_encode($totalPendingAmountByPercentage);
        $paymentStatus = $this->createJson('False', 'False', 'False', 'False', 'False', 'False', 'False', 'False', 'False', 'False', 'False', 'False', 'False', 'False');
        $paymentStatusJSON = json_encode($paymentStatus);
        $pendingPayment = $this->createJson(null, null, null, null, null, null, null, null, null, null, null, null, null, null);
        $pendingPaymentJSON = json_encode($pendingPayment);
        $query = "INSERT INTO `payment_datails` (`amount`,`payment_status`,`booking_id`,`paymentDate`,`payment`,`pendingPayment`,`totalPending`) VALUES(?,?,?,?,?,?,?)";
        $stmt = $mysqli->prepare($query);
        if (false === $stmt) {
            trigger_error("Error in query: " . mysqli_connect_error(), E_USER_ERROR);
        } else {
            $stmt->bind_param('ssissss', $amountByPercentageJSON, $paymentStatusJSON, $booking_id, $paymentdatesJSON, $paymentReceivedJSON, $pendingPaymentJSON,$totalPendingAmountByPercentageJSON);
            $stmt->execute();
        }
    }
//Gets Payment Schedule here from paymentdates table
    public function getPaymentSchedule()
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT * FROM paymentdates";
        $stmt = $mysqli->query($query);
        return $stmt;
    }
//Store Package Amount, calculates Percentage wise amount, updates due table (called from Payment.php)
    public function store_Package_Amount($packageAmount, $id)
    {   
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT package_amount from `payment_datails` where booking_id='".$id."'";
        $stmt = $mysqli->query($query);
        if((($stmt->fetch_object())->package_amount) == 0){
            $amountByPercentage = $this->create_Payment_json($packageAmount);
            $amountByPercentageJSON = json_encode($amountByPercentage);
            $query = "UPDATE `payment_datails` set package_amount=?,amount=?,totalPending=? where booking_id=?";
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('issi', $packageAmount, $amountByPercentageJSON,$amountByPercentageJSON, $id);
            $stmt->execute();
        }
        $this->updateDueAmountBydate($id);
        sleep(1);
        return $this->showPayment($id);
    }
//Create Payment JSON
    public function create_Payment_json($amount)
    {
        $myObj = array(
            "key1" => ($amount / 100) * 10, "key2" => ($amount / 100) * 20, "key3" => ($amount / 100) * 15, "key4" => ($amount / 100) * 5, "key5" => ($amount / 100) * 4, "key6" => ($amount / 100) * 4,
            "key7" => ($amount / 100) * 4, "key8" => ($amount / 100) * 4, "key9" => ($amount / 100) * 4, "key10" => ($amount / 100) * 5,
            "key11" => ($amount / 100) * 5, "key12" => ($amount / 100) * 5, "key13" => ($amount / 100) * 10, "key14" => ($amount / 100) * 5);
        return $myObj;
    }
//Update due according to date, and updates whole due table
    public function updateDueAmountBydate($id)
    {
        $rs = $this->getPaymentDetails($id);
        $res = $rs->fetch_object();
        $index = 0;
        $data = array();
        foreach ($res as $key) {
            $data[$index] = $key;
            $index++;
        }
        $amount = json_decode($data[0]);
        $payment_status = json_decode($data[1]);
        $package_amount = $data[2];
        $paymentDone = unserialize($data[3]);
        $pendingPayment = json_decode($data[4]);
        $totalPendingAmount = json_decode($data[5]);
        $paidAmount = 0;
        $pendingAmount = 0;
        $dueTillToday = 0;
        $arr = array("hgh", "key1", "key2", "key3", "key4", "key5", "key6", "key7", "key8", "key9", "key10", "key11", "key12", "key13", "key14");
        for ($i = 1; $i < 15; $i++) {
            $xyz = $arr[$i];
            if ((is_null($pendingPayment->$xyz) || $pendingPayment->$xyz > 0 ) && (date((($this->getPaymentDate($i))->fetch_object())->paymentDate) <= date('Y-m-d'))) {
                $pendingPayment->$xyz = $totalPendingAmount->$xyz;
            } elseif (is_null($pendingPayment->$xyz) && (date((($this->getPaymentDate($i))->fetch_object())->paymentDate) > date('Y-m-d'))) {
                $pendingPayment->$xyz = null;
            } else {
                $pendingPayment->$xyz = $pendingPayment->$xyz;
            }
        }
        $dueTillToday = $this->getTotalOfDueTillToday($pendingPayment);
        $totalPendingAmount = $this->getTotalOfDueTillToday($totalPendingAmount);
        $paidTotal = $this->getTotalOfPaid($paymentDone); 
        $pendingTotal = $package_amount - $paidTotal;
        // var_dump(($package_amount - $paidTotal) == $totalPendingAmount);
        $pendingPayment = json_encode($pendingPayment);
        $this->UpdatePendingPaymentByDate($id, $pendingPayment);
        $this->UpdateDueTable($id,$package_amount,$paidTotal,$pendingTotal,$dueTillToday);
    }
//Get amount by percentage, payment status,package amount,pending payment 
    public function getPaymentDetails($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT amount,payment_status,package_amount,payment,pendingPayment,totalPending FROM payment_datails  where booking_id='" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }
//Get payment dates only
    public function getPaymentDate($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT paymentDate FROM paymentdates where id = '" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }
//Calculate Total of due till today and other totals
    function getTotalOfDueTillToday($pendingPayment)
    {   
        $total = 0;
        $arr = array("hgh", "key1", "key2", "key3", "key4", "key5", "key6", "key7", "key8", "key9", "key10", "key11", "key12", "key13", "key14");
        for ($i = 1; $i < 15; $i++) {
            $xyz = $arr[$i];
            $total = $total + $pendingPayment->$xyz;
        }
        return $total;
    }
//Calculate Total of Paid
    function getTotalOfPaid($paymentDone){
        $total = 0;
        for ($i=0; $i <sizeof($paymentDone) ; $i++) { 
            $total = $total + ($paymentDone[$i])["amount"];
        }
        return $total;
    }
    public function UpdatePendingPaymentByDate($id, $totalPending)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "UPDATE `payment_datails` SET `pendingPayment`=? WHERE `booking_id`=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('si', $totalPending, $id);
        $stmt->execute();
        // header('location:viewBooking.php');
    }
//Update Pending Payment    
    public function UpdatePendingPayment($id, $totalPending)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "UPDATE `payment_datails` SET `totalPending`=? WHERE `booking_id`=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('si', $totalPending, $id);
        $stmt->execute();
        // header('location:viewBooking.php');
    }
//Update due payment table
    public function UpdateDueTable($id, $package_amount, $paidAmount, $pendingAmount, $dueTillToday)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "UPDATE `due` SET `Package`=?,`Paid`=?,`totalDue`=?,`dueTillToday`=? WHERE `booking_id`=?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('iiiii', $package_amount, $paidAmount, $pendingAmount, $dueTillToday, $id);
        $stmt->execute();
    }
//Adds payment and date to payment details table and updates due table
    public function addPayment($payment, $id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $stmt = $this->getPayment($id);
        $payment1 = unserialize(($stmt->fetch_object())->payment);
        $addPayment = $this->createPaymentJson($payment);
        array_push($payment1, $addPayment);
        $payment2 = serialize($payment1);
        $query = "UPDATE `payment_datails` set payment=? where booking_id = ?";
        $stmt = $mysqli->prepare($query);
        $stmt->bind_param('si', $payment2, $id);
        $stmt->execute();
        $this->subtactPayment($id, $payment);
        return $this->getPayment($id);

    }
//Gets payment column from payment Details
    public function getPayment($id)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $query = "SELECT  payment from payment_datails where booking_id = '" . $id . "'";
        $stmt = $mysqli->query($query);
        return $stmt;
    }
//Creates Payment Object
    public function createPaymentJson($d1)
    {
        $myObj = array("amount" => $d1, "date" => date('Y-m-d'));
        return $myObj;
    }
//Subtracts newly added payment from Due till today
    public function subtactPayment($id, $payment)
    {
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $rs = $this->getPaymentDetails($id);
        $res = $rs->fetch_object();
        $index = 0;
        $data = array();
        foreach ($res as $key) {
            $data[$index] = $key;
            $index++;
        }
        $pendingPayment = json_decode($data[4]);
        $totalPending = json_decode($data[5]);
        $arr = array("hgh", "key1", "key2", "key3", "key4", "key5", "key6", "key7", "key8", "key9", "key10", "key11", "key12", "key13", "key14");
        for ($i = 1; $i < 15; $i++) {
            $xyz = $arr[$i];
            if (($totalPending->$xyz) > 0 && $payment > 0) {
                $result = $totalPending->$xyz - $payment;
                if ($result == 0) {
                    $totalPending->$xyz = $result;
                    $payment = $result;
                } elseif ($result > 0) {
                    $totalPending->$xyz = $result;
                    $payment = 0;
                } else {
                    $totalPending->$xyz = 0;
                    $payment = abs($result);
                }
            } else{
                $totalPending->$xyz = $totalPending->$xyz;
            }
        }
        $totalPending = json_encode($totalPending);
        $this->UpdatePendingPayment($id, $totalPending);
        $this->updateDueAmountBydate($id);
    }
}
