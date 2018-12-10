<?php

require_once 'connections.php';
use \Carbon\Carbon;

try {

    /*
     * added users from app
     */

    $usersFromApp = $dbApp->query("select * from " . $schema . "intouch_user");

    foreach ($usersFromApp as $user){
        $userCredentionals = $dbApp->query("SELECT * FROM " . $schema . "email_password_principal WHERE user_id='".$user['id']."'");
        $userCredentionals = $userCredentionals->fetch(PDO::FETCH_ASSOC);

        if(!$userCredentionals){
            continue;
        }

        $existUserInSite = $dbSite->query("SELECT * FROM users WHERE email='" .$userCredentionals['email'] . "'");
        $existUserInSite = $existUserInSite->fetch(PDO::FETCH_ASSOC);
        $userRole = $dbApp->query("SELECT r.name FROM " . $schema . "role r "
            . "JOIN " . $schema . "user_2_role ur ON ur.role_id=r.id "
            . "JOIN " . $schema . "intouch_user iu ON ur.user_id=iu.id WHERE iu.id='" . $user['id'] . "'");
        $userRole = $userRole->fetch(PDO::FETCH_ASSOC);
        if($userRole['name'] == 'ADMIN'){
            $role = 'admin';
        }else{
            $role = 'default';
        }

        $userAvatar = $dbApp->query("select obj.* from " . $schema . "stored_object obj "
            . "join " . $schema . "user_avatar ua on ua.stored_object_id=obj.id where ua.owner_id='".$user['id']."'");
        $userAvatar = $userAvatar->fetch(PDO::FETCH_ASSOC);

        if($userAvatar){
            $linkToAvatar = 'https://s3-eu-west-1.amazonaws.com/assets.showapp.ru/original/' . $userAvatar['prefix'] . '/' . $userAvatar['stored_name'];
        }else{
            $linkToAvatar = null;
        }

        if($existUserInSite){
            $row = [
                'id' => $existUserInSite['id'],
                'firstName' => $user['nick_name'],
                'email' => $userCredentionals['email'],
                'password' => $userCredentionals['password'],
                'photo' => $linkToAvatar,
                'userType' => $role
            ];

            $sql = "UPDATE users SET firstName=:firstName, email=:email, password=:password, photo=:photo, `type`=:userType WHERE id=:id;";
            $status = $dbSite->prepare($sql)->execute($row);

        }else{
            $row = [
                'firstName' => $user['nick_name'],
                'email' => $userCredentionals['email'],
                'password' => $userCredentionals['password'],
                'photo' => $linkToAvatar,
                'userType' => $role
            ];

            $sql = "INSERT INTO users SET firstName=:firstName, email=:email, password=:password, photo=:photo, `type`=:userType;";
	echo $sql;
            $status = $dbSite->prepare($sql)->execute($row);
            /*if ($status) {
                $lastId = $dbSite->lastInsertId();
                dump($lastId);
            }*/
        }
    }

    /*
     * added events from app
     */

    $eventsFromApp = $dbApp->query("SELECT * FROM " . $schema . "event where start_date>='" . Carbon::now() . "'");

    foreach ($eventsFromApp as $event){

        $dateStart = explode(" ", $event['start_date']);
        $dateEnd = explode(" ", $event['end_date']);
        $status = '';
        if($event['status'] == 'ACTIVE'){
            $status = 'false';
        }else{
            $status = 'true';
        }

        $eventFromSite = $dbSite->query("SELECT * from events where title='" . $event['title'] . "' and dateStart='" . $dateStart[0] . "' and timeStart='" . $dateStart[1] . "' and address='" . $event['g_title'] ."'");
        $eventFromSite = $eventFromSite->fetch(PDO::FETCH_ASSOC);

        $eventImage = $dbApp->query("select obj.* from " . $schema . "stored_object obj "
            . "join " . $schema . "event_media med on med.object_id=obj.id "
            . "join " . $schema . "event ev on ev.cover_id=med.id where ev.id='".$event['id']."'");
        $eventImage = $eventImage->fetch(PDO::FETCH_ASSOC);
        $imageLink = 'https://s3-eu-west-1.amazonaws.com/assets.showapp.ru/original/' . $eventImage['prefix'] . '/' . $eventImage['stored_name'];

        $eventOwnerEmail = $dbApp->query("Select email FROM " . $schema . "email_password_principal WHERE user_id='" . $event['user_id'] . "'");
        $eventOwnerEmail = $eventOwnerEmail->fetch(PDO::FETCH_ASSOC);

        if($eventOwnerEmail){
            $userId = $dbSite->query("SELECT id FROM users WHERE email='" . $eventOwnerEmail['email'] . "'");
            $userId = $userId->fetch(PDO::FETCH_ASSOC);
        }else{
            $userId = null;
        }

        if($eventFromSite){
            if($event['update_date'] > $eventFromSite['updated_at']) {
                $row = [
                    'id' => $eventFromSite['id'],
                    'userId' => $userId['id'],
                    'title' => $event['title'],
                    'description' => $event['description'],
                    'address' => $event['g_title'],
                    'dateStart' => $dateStart[0],
                    'timeStart' => $dateStart[1],
                    'dateEnd' => $dateEnd[0],
                    'timeEnd' => $dateEnd[1],
                    'eventImage' => $imageLink,
                    'ageRestrictions' => $event['censor_rate'] . '+',
                    'coverTitle' => $event['title'],
                    'coverImage' => $imageLink,
                    'is_delete' => $status,
                    'url' => $event['shop_link'],
                ];

                $sql = "UPDATE events SET userId=:userId, title=:title, description=:description, address=:address, "
                    . "dateStart=:dateStart, timeStart=:timeStart, dateEnd=:dateEnd, timeEnd=:timeEnd, "
                    . "eventImage=:eventImage, ageRestrictions=:ageRestrictions, coverTitle=:coverTitle, "
                    . "coverImage=:coverImage, is_delete=:is_delete, url=:url WHERE id=:id;";
                $status = $dbSite->prepare($sql)->execute($row);
            }
        }else{
            $row = [
                'userId' => $userId['id'],
                'title' => $event['title'],
                'description' => $event['description'],
                'address' => $event['g_title'],
                'dateStart' => $dateStart[0],
                'timeStart' => $dateStart[1],
                'dateEnd' => $dateEnd[0],
                'timeEnd' => $dateEnd[1],
                'eventImage' => $imageLink,
                'ageRestrictions' => $event['censor_rate'] . '+',
                'coverTitle' => $event['title'],
                'coverImage' => $imageLink,
                'is_delete' => $status,
                'url' => $event['shop_link'],
            ];

            $sql = "INSERT INTO events SET userId=:userId, title=:title, description=:description, address=:address, "
            . "dateStart=:dateStart, timeStart=:timeStart, dateEnd=:dateEnd, timeEnd=:timeEnd, "
            . "eventImage=:eventImage, ageRestrictions=:ageRestrictions, coverTitle=:coverTitle, "
            . "coverImage=:coverImage, is_delete=:is_delete, url=:url;";
            $status = $dbSite->prepare($sql)->execute($row);

        }
    }

}catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . "<br/>" ;
    die();
}catch (\Exception $e) {
    echo "Error!: " . $e->getMessage() . "<br/>" ;
    die();
}
