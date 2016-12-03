<?php
/**
 * Created by iKNSA.
 * Author: Khalid Sookia <khalidsookia@gmail.com>
 * Date: 29/11/16
 * Time: 23:32
 */

namespace Bnpparibas\Cardif\ModifAdministrativesBddfCardifBundle\Controller;


use Bnpparibas\Cardif\ModifAdministrativesBddfCardifBundle\Entity\User;
use Romenys\Framework\Components\UrlGenerator;
use Romenys\Framework\Controller\Controller;
use Romenys\Http\Request\Request;
use Romenys\Http\Response\JsonResponse;

class ModifAdministrativesBddfCardifController extends Controller
{
    public function __construct()
    {
    }

    public function homepageAction(Request $request)
    {
        $urlGenerator = new UrlGenerator($request);

        return new JsonResponse(['form' => $urlGenerator->absolute("form")], [JSON_UNESCAPED_SLASHES]);
    }

    public function newAction(Request $request)
    {
        $user = new User();
        $user->hydrate($request->getPost());

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
    }
}