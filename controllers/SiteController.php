<?php
namespace app\controllers;
use linhtv\phpmvc\Application;
use linhtv\phpmvc\Controller;
use linhtv\phpmvc\Request;
use linhtv\phpmvc\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
          'name' => "Tran Van Linh",
        ];
        return $this->render('home', $params);
    }
    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contact us');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact

        ]);
    }
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
        return 'Handel contact';
    }
}