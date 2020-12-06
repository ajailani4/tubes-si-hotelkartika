<?php

include_once("model/database/config.php");
include_once("model/data/fasilitas.php");
include_once("model/data/user.php");
include_once("model/data/booking-history.php");

class Repository {
    //Register user
    function registerUser($user) {
        $config = new Config();

        //Check if there has been same username
        $result = mysqli_query($config->connect(), "SELECT * FROM user WHERE username='$user->username'");

        if(mysqli_num_rows($result) > 0) {
            echo("<script>alert('Username sudah ada')</script>");
        } else {
            if(
                $user->username != null || $user->password != null || $user->nama != null || 
                $user->email != null || $user->noHp != null || $user->nik != null
            ) {
                $user->password = password_hash($user->password, PASSWORD_DEFAULT);

                $result = mysqli_query($config->connect(), "INSERT INTO user(username, password, nama, email, no_hp, nik) VALUES(
                    '$user->username', '$user->password', '$user->nama', 
                    '$user->email', '$user->noHp', '$user->nik'
                )");

                return $result;
            } else {
                echo("<script>alert('Isi data dengan lengkap')</script>");
            }
        }
    }

    //Login user
    function loginUser($user) {
        $config = new Config();

        $result = mysqli_query($config->connect(), "SELECT * FROM user WHERE username='$user->username'");

        if(mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);

            if(password_verify($user->password, $data["password"])) {
                return true;
            } else {
                return false;
            }
        }
    }

    //Get bedroom class list
    function getBedroomClass() {
        $config = new Config();
        $listBedroomClass = array();

        $result = mysqli_query($config->connect(), "SELECT * FROM fasilitas WHERE nama='Kamar'");
        
        while($data = mysqli_fetch_array($result)) {
            $fasilitas = new Fasilitas();

            $fasilitas->id = $data["id"];
            $fasilitas->nama = $data["nama"];
            $fasilitas->kelas = $data["kelas"];
            $fasilitas->harga = $data["harga"];
            $fasilitas->satuan = $data["satuan"];
            $fasilitas->foto = $data["foto"];

            array_push($listBedroomClass, $fasilitas);
        }

        return $listBedroomClass;
    }

    //Get meeting room class list
    function getMeetingRoomClass() {
        $config = new Config();
        $listMeetingRoomClass = array();

        $result = mysqli_query($config->connect(), "SELECT * FROM fasilitas WHERE nama='Meeting Room'");

        while($data = mysqli_fetch_array($result)) {
            $fasilitas = new Fasilitas();

            $fasilitas->id = $data["id"];
            $fasilitas->nama = $data["nama"];
            $fasilitas->kelas = $data["kelas"];
            $fasilitas->harga = $data["harga"];
            $fasilitas->satuan = $data["satuan"];
            $fasilitas->foto = $data["foto"];

            array_push($listMeetingRoomClass, $fasilitas);
        }

        return $listMeetingRoomClass;
    }

    //Get other facilities list
    function getOthers() {
        $config = new Config();
        $listOthers = array();

        $result = mysqli_query($config->connect(), "SELECT * FROM fasilitas WHERE nama='Lainnya'");

        while($data = mysqli_fetch_array($result)) {
            $fasilitas = new Fasilitas();

            $fasilitas->id = $data["id"];
            $fasilitas->nama = $data["nama"];
            $fasilitas->kelas = $data["kelas"];
            $fasilitas->harga = $data["harga"];
            $fasilitas->satuan = $data["satuan"];
            $fasilitas->foto = $data["foto"];

            array_push($listOthers, $fasilitas);
        }

        return $listOthers;
    }

    //Get the bedroom detail
    function getFacilityDetail($id) {
        $config = new Config();
        $fasilitas = new Fasilitas();

        $result = mysqli_query($config->connect(), "SELECT * FROM fasilitas WHERE id='$id'");

        if(mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);

            $fasilitas->id = $data["id"];
            $fasilitas->nama = $data["nama"];
            $fasilitas->kelas = $data["kelas"];
            $fasilitas->harga = $data["harga"];
            $fasilitas->satuan = $data["satuan"];
            $fasilitas->foto = $data["foto"];
            $fasilitas->deskripsi = $data["deskripsi"];

            return $fasilitas;
        }
    }

    //Get bedroom list based on its class
    function getBedroomList($id) {
        $config = new Config();
        $listBedroom = array();
        $class = "";

        switch($id) {
            case "F0101":
                $class = "Standard";
                break;
            case "F0102":
                $class = "Superior";
                break;
            case "F0103":
                $class = "Deluxe";
                break;
        }

        $result = mysqli_query($config->connect(), "SELECT nomor FROM kamar WHERE kelas='$class' AND status='0'");

        while($data = mysqli_fetch_array($result)) {
            array_push($listBedroom, $data["nomor"]);
        }

        return $listBedroom;
    }

    //Book the bedroom
    function bookBedroom($transaksi, $username, $noKamar) {
        $config = new Config();

        $transaksiRow = mysqli_query($config->connect(), "SELECT * FROM transaksi");
        $transaksiId = mysqli_num_rows($transaksiRow) + 1;
        

        //Insert into transaksi table
        mysqli_query($config->connect(), "INSERT INTO transaksi(id, fasilitas, check_in, check_out, harga, status) VALUES(
            '$transaksiId', '$transaksi->fasilitas', '$transaksi->checkIn', '$transaksi->checkOut', '$transaksi->harga', '$transaksi->status'
        )");

        //Insert into melakukan table
        mysqli_query($config->connect(), "INSERT INTO melakukan(user, transaksi) VALUES(
            '$username', '$transaksiId'
        )");

        //Update kamar table
        mysqli_query($config->connect(), "UPDATE kamar SET status='1' WHERE nomor='$noKamar'");
    }

    //Get bedroom list based on its class
    function getMeetingRoomList($id) {
        $config = new Config();
        $listMeetingRoom = array();
        $class = "";

        switch($id) {
            case "F0201":
                $class = "Reguler";
                break;
            case "F0202":
                $class = "VIP";
                break;
            case "F0203":
                $class = "VVIP";
                break;
        }

        $result = mysqli_query($config->connect(), "SELECT nomor FROM meeting_room WHERE kelas='$class' AND status='0'");

        while($data = mysqli_fetch_array($result)) {
            array_push($listMeetingRoom, $data["nomor"]);
        }

        return $listMeetingRoom;
    }

    //Book the meeting room
    function bookMeetingRoom($transaksi, $username, $noMeetingRoom) {
        $config = new Config();

        $transaksiRow = mysqli_query($config->connect(), "SELECT * FROM transaksi");
        $transaksiId = mysqli_num_rows($transaksiRow) + 1;
        

        //Insert into transaksi table
        mysqli_query($config->connect(), "INSERT INTO transaksi(id, fasilitas, check_in, check_out, harga, status) VALUES(
            '$transaksiId', '$transaksi->fasilitas', '$transaksi->checkIn', '$transaksi->checkOut', '$transaksi->harga', '$transaksi->status'
        )");

        //Insert into melakukan table
        mysqli_query($config->connect(), "INSERT INTO melakukan(user, transaksi) VALUES(
            '$username', '$transaksiId'
        )");

        //Update kamar table
        mysqli_query($config->connect(), "UPDATE meeting_room SET status='1' WHERE nomor='$noMeetingRoom'");
    }

    //Get profile
    function getUserProfile($username) {
        $config = new Config();
        $user = new User();

        $result = mysqli_query($config->connect(), "SELECT * FROM user WHERE username='$username'");

        if(mysqli_num_rows($result) == 1) {
            $data = mysqli_fetch_assoc($result);

            $user->nama = $data["nama"];
            $user->email = $data["email"];

            return $user;
        }
    }

    //Get user booking history
    function getBookingHistory($username) {
        $config = new Config();
        $listBookingHistory = array();

        $result = mysqli_query($config->connect(), 
            "SELECT fasilitas.nama, fasilitas.kelas, transaksi.status, transaksi.harga, transaksi.check_in 
            FROM melakukan 
                    INNER JOIN transaksi ON melakukan.transaksi=transaksi.id
                    INNER JOIN fasilitas ON transaksi.fasilitas=fasilitas.id
            WHERE melakukan.user='$username'
        ");

        while($data = mysqli_fetch_array($result)) {
            $bookingHistory = new BookingHistory();

            $bookingHistory->nama = $data["nama"];
            $bookingHistory->kelas = $data["kelas"];
            $bookingHistory->status = $data["status"];
            $bookingHistory->harga = $data["harga"];

            $checkIn = new DateTime($data["check_in"]);
            $bookingHistory->checkIn = $checkIn->format("Y-m-d");

            array_push($listBookingHistory, $bookingHistory);
        }

        return $listBookingHistory;
    }
}

?>