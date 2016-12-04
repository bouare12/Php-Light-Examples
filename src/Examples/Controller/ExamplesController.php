<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 04/12/16
 * Time: 00:08
 */

namespace Examples\Controller;

use Examples\Entity\User;
use Romenys\Framework\Components\DB\DB;
use Romenys\Framework\Components\UrlGenerator;
use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;

class ExamplesController extends Controller
{
    public function listAction()
    {
        $db = new DB();
        $db = $db->connect();

        $request = $db->query("SELECT * FROM `user`");
        $users = $request->fetchAll($db::FETCH_ASSOC);

        return new JsonResponse(["users" => $users]);
    }

    public function newAction(Request $request)
    {
        $request->uploadFiles();

        $user = new User($request->getPost()["user"]);
        $user->setAvatar($request->getUploadedFiles()["avatar"]["uploaded_file"]);

        $db = new DB();
        $db = $db->connect();

        $query = $db->prepare("INSERT INTO `modifcardif`.`user` (`name`, `email`, `avatar`) VALUES (:name, :email, :avatar)");

        $query->bindValue(":name", $user->getName());
        $query->bindValue(":email", $user->getEmail());
        $query->bindValue(":avatar", $user->getAvatar());

        $query->execute();


        return new JsonResponse([
            "user" => [
                "name" => $user->getName(),
                "email" => $user->getEmail(),
                "avatar" => $user->getAvatar()
            ]
        ]);
    }

    public function showAction(Request $request)
    {
        $params = $request->getGet();
        $id = $params["id"];

        $db = new DB();
        $db = $db->connect();

        $user = $db->query("SELECT * FROM `user` WHERE id = " . $id)->fetch($db::FETCH_ASSOC);

        $user = new User($user);

        return new JsonResponse([
            "user" => [
                "name" => $user->getName(),
                "email" => $user->getEmail()
            ]
        ]);
    }

    public function formAction(Request $request)
    {
        $request->uploadFiles();

        return new JsonResponse([
            'uploadedFiles' => $request->getUploadedFiles(),
            'post' => $request->getPost(),
            'get' => $request->getGet(),
            'file' => $request->getOneFile('user', 'avatar'),
            'files' => $request->getFiles(),
            'session' => $request->getSession()
        ]);
    }

    public function defaultAction(Request $request)
    {
        $urlGenerator = new UrlGenerator($request);

        return new JsonResponse(['form' => $urlGenerator->absolute("form")], [JSON_UNESCAPED_SLASHES]);
    }
}