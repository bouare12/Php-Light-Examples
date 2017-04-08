<?php


namespace UserBundle\Repository;

use PhpLight\Framework\Components\DB\DB;
use UserBundle\Entity\User;

class UserRepository
{
    
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
}
