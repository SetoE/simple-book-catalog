<?php

namespace App\Controller;

class Book
{
    public function indexAction()
    {
        echo 'This is the index action';
    }

    public function createAction()
    {
        echo 'This is the create action';
    }

    public function editAction()
    {
        echo 'This is the edit action';
    }

    public function viewAction($req, $res)
    {
        $res->toJSON([
            'book' =>  ['id' => $req->params[0]],
            'status' => 'ok'
        ]);
        echo 'This is the view action';
    }

    public function deleteAction()
    {
        echo 'This is the delete action';
    }
}
