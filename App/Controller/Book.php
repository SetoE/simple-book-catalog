<?php

namespace App\Controller;

use App\Lib\Request;
use App\Lib\Response;
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

    public function createAction(Request $req, Response $res)
    {
        $book = new ModelBook();
        $input = $req->getBody();
        unset($input['id']);
        $bookCreated = $book->create($input);
        

        if ($bookCreated) {
            return $res->toJSON([
                'book' => [
                    'id' => $bookCreated->id,
                    'title' => $bookCreated->title,
                    'isbn' => $bookCreated->isbn,
                    'author' => $bookCreated->author,
                    'publisher' => $bookCreated->publisher,
                    'year_published' => $bookCreated->year_published,
                    'category' => $bookCreated->category,
                    'created_at' => $bookCreated->created_at,
                    'edited_at' => $bookCreated->edited_at,
                    'status' => $bookCreated->status,
                ],
                'status' => 'OK'
            ]);
        }
        return $res->toJSON([
            'status' => 'ERROR',
        ]);
    }

    public function updateAction($req, $res)
    {
        $input = $req->getBody();
        $model = $this->findModel($input['id']);
        $input['edited_at'] = date('Y-m-d H:i:s');
        $bookUpdated = $model->save($input);

        if ($bookUpdated) {
            return $res->toJSON([
                'book' => [
                    'id' => $bookUpdated->id,
                    'title' => $bookUpdated->title,
                    'isbn' => $bookUpdated->isbn,
                    'author' => $bookUpdated->author,
                    'publisher' => $bookUpdated->publisher,
                    'year_published' => $bookUpdated->year_published,
                    'category' => $bookUpdated->category,
                    'created_at' => $bookUpdated->created_at,
                    'edited_at' => $bookUpdated->edited_at,
                    'status' => $bookUpdated->status,
                ],
                'status' => 'OK'
            ]);
        }

        return $res->toJSON([
            'status' => 'ERROR',
        ]);
    }

    public function viewAction($req, $res)
    {
        $model = $this->findModel($req->params[0]);
        return $res->toJSON([
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

        return $res->toJSON([
            'status' => 'ERROR',
        ]);
    }

    public function deleteAction($req, $res)
    {
        $model = new ModelBook();
        $isDeleted = $model->remove($req->params[0]);

        if ($isDeleted) {
            return $res->toJSON([
                'status' => 'OK'
            ]);
        }
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
