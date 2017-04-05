<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 24/01/17
 * Time: 13:30
 */

namespace UserBundle\Repository;


use PhpLight\Framework\Components\DB\DB;
use UserBundle\Entity\User;

class UserRepository
{
    public function findByUniqueId($uniqueId)
    {
        $db = (new DB())->connect();

        $userData = $db->query("SELECT * FROM `user` WHERE `uniqueId` = '" . $uniqueId . "'")->fetch($db::FETCH_ASSOC);

        return new User($userData);
    }
    
    public function create(User $user)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(
            "INSERT INTO `user` (`uniqueId`, `name`, `email`, `createdAt`) VALUES (:uniqueId, :name, :email, :createdAt)"
        );

        $query->bindValue(':uniqueId', $user->getUniqueId());
        $query->bindValue(':name', $user->getName());
        $query->bindValue(':email', $user->getEmail());
        $query->bindValue(':createdAt', $user->getCreatedAt()->format('Y-m-d H:i:s'));

        return $query->execute();
    }

    public function listAll()
    {
        $db = new DB();
        $db = $db->connect();

        $query = $db->query("SELECT * FROM `user`");
        $usersArray = $query->fetchAll($db::FETCH_ASSOC);

        $users = [];
        foreach ($usersArray as $data) {
            $users[] = new User($data);
        }

        return $users;
    }

    public function update(User $user)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(" UPDATE `user` SET `name` = '".$user->getName()."', `email` = '".$user->getEmail().
            "' WHERE `uniqueId` =" . $user->getUniqueId());

        $query->execute();

        $newUser = $this->findByUniqueId($user->getUniqueId());

        return $newUser;
    }

    public function delete(User $user)
    {
        $db = (new DB())->connect();

        $query = $db->prepare(" DELETE FROM 'user' WHERE id = '".$user->getId()."'");

        return $query->execute();
    }
}
