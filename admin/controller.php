<?php

    ob_start();
    session_start();

    require_once 'connect.php';




    if(isset($_POST['siginup'])){
        
        
            //veritabani kayid islemi
            $sorgu = $db->prepare('INSERT INTO login SET user_name =:name, user_mail =:mail , user_password =:password');
            $ekle = $sorgu->execute(array(
                'name' => $_POST['username'],
                'mail' => $_POST['usermail'],
                'password' => md5($_POST['userpassword'])
            ));
            $data['status']="success";
            $data['message']="Giriş Başarılı";
            echo json_encode($data);
            
    }


    if(isset($_POST['login'])){

        $kullanici_sor=$db->prepare("SELECT * FROM login where user_mail=:mail and user_password=:password ");
        $kullanici_sor->execute(array(
            'mail' => $_POST['usermail'],
            'password' => md5($_POST['userpassword'])
        ));
        $say=$kullanici_sor->rowCount();

        if($say>0){

            $_SESSION['userkullanici_mail']=$_POST['usermail'];

            $data['status']="success";
            $data['message']="Giriş Başarılı";
            echo json_encode($data);

        } else{

            $data['status']="error";
            $data['message']="Kullanıcı Bulunamadı";
            echo json_encode($data);
        }

    }
    if(isset($_POST['teklifver'])){
        
        
        //veritabani kayid islemi
        $sorgu = $db->prepare('INSERT INTO productoffers SET productId=:id, offerHead =:head , offerValue =:price');
        $ekle = $sorgu->execute(array(
            'id' => $_POST['productid'],
            'head' => $_POST['aciklama'],
            'price' => $_POST['teklifdegeri']
        ));
        $data['status']="success";
        $data['message']="Teklif Başarılı";
        echo json_encode($data);
        
}
    

?>