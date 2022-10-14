<?php

namespace App\Controller;

use App\Model\Book as ModelBook;
use Exception;

class Book extends Controller
{
    public function indexAction()
    {
        $models = (new ModelBook)->all();

        $this->render('index', [
            'books' => $models,
        ]);
    }

    public function createAction($req, $res)
    {
        echo 'This is the create action';
    }

    public function editAction($req, $res)
    {
        echo 'This is the edit action';
    }

    public function viewAction($req, $res)
    {
        $model = $this->findModel($req->params[0]);
        $res->toJSON([
            'book' =>  [
                'id' => $model->id,
                'title' => $model->title,
                'isbn' => $model->isbn,
                'author' => $model->author,
                'publisher' => $model->publisher,
                'year_published' => $model->year_published,
                'category' => $model->category,
                'created_at' => $model->created_at,
                'edited_at' => $model->edited_at,
                'status' => $model->status,
            ],
            'status' => 'ok'
        ]);
    }

    public function deleteAction($req, $res)
    {
        echo 'This is the delete action';
    }

    private function findModel($id)
    {
        $book = new ModelBook();

        $book = $book->find($id);

        if (!$book) {
            throw new Exception('Unable to find book');
        }

        return $book;
    }
}
