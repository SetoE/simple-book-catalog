<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="/web/css/style.css">
    <title>Simple Book Catalog</title>
</head>

<body>
    <div class="container h-100">
        <div class="row no-gutters mt-auto">
            <div class="col-md-3 offset-md-9">
                <button class="btn add-button btn-success btn-lg btn-block">Add</button>
            </div>
        </div>

        <div class="row no-gutters">
            <table class="table table-bordered">
                <tr>
                    <th class="py-4">TITLE</th>
                    <th class="py-4">ISBN</th>
                    <th class="py-4">AUTHOR</th>
                    <th class="py-4">PUBLISHER</th>
                    <th class="py-4">YEAR PUBLISHED</th>
                    <th class="py-4">CATEGORY</th>
                </tr>
                <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($book->title); ?></td>
                        <td><?php echo e($book->isbn); ?></td>
                        <td><?php echo e($book->author); ?></td>
                        <td><?php echo e($book->publisher); ?></td>
                        <td><?php echo e($book->year_published); ?></td>
                        <td><?php echo e($book->category); ?></td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </table>
        </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="create" method="post">
                    <div class="modal-body">
                        <div class="form-group"><label for="title">Title</label><input name="title" type="text"
                                class="form-control"></div>
                        <div class="form-group"><label for="isbn">ISBN</label><input name="isbn" type="text"
                                class="form-control"></div>
                        <div class="form-group"><label for="author">Author</label><input name="author" type="text"
                                class="form-control"></div>
                        <div class="form-group"><label for="publisher">Publisher</label><input name="publisher"
                                type="text" class="form-control"></div>
                        <div class="form-group"><label for="year_published">Year Published</label><input
                                name="year_published" type="number" class="form-control"></div>
                        <div class="form-group"><label for="category">Category</label><input type="text"
                                name="category" class="form-control"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function() {
            $('.add-button').on('click', function() {
                $('#addModal').modal({
                    keyboard: false
                });
            });


        });
    </script>


</body>

</html>
<?php /**PATH C:\xampp\htdocs\simple-book-catalog\simple-book-catalog\App\Views/index.blade.php ENDPATH**/ ?>