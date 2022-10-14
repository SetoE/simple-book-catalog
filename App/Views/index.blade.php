<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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

        <div class="row no-gutters table-row">
            <table class="table table-bordered">
                <tr>
                    <th class="py-4">TITLE</th>
                    <th class="py-4">ISBN</th>
                    <th class="py-4">AUTHOR</th>
                    <th class="py-4">PUBLISHER</th>
                    <th class="py-4">YEAR PUBLISHED</th>
                    <th class="py-4">CATEGORY</th>
                    <th></th>
                </tr>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->year_published }}</td>
                        <td>{{ $book->category }}</td>
                        <td class="text-center">
                            <button class="edit-button btn btn-secondary" value="{{ $book->id }}">
                                EDIT
                            </button>
                            <button class="delete-button btn btn-secondary" value="{{ $book->id }}">
                                DELETE
                            </button>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>


    <div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add/Edit Book</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="create" id="form" method="post">
                    <div class="modal-body">
                        <input type="hidden" id="id" name="id">
                        <div class="form-group"><label for="title">Title</label><input id="title" name="title"
                                type="text" class="form-control"></div>
                        <div class="form-group"><label for="isbn">ISBN</label><input id="isbn" name="isbn"
                                type="text" class="form-control"></div>
                        <div class="form-group"><label for="author">Author</label><input id="author"name="author"
                                type="text" class="form-control"></div>
                        <div class="form-group"><label for="publisher">Publisher</label><input id="publisher"
                                name="publisher" type="text" class="form-control"></div>
                        <div class="form-group"><label for="year_published">Year Published</label><input
                                id="year_published" name="year_published" type="number" class="form-control"></div>
                        <div class="form-group"><label for="category">Category</label><input type="text"
                                id='category' name="category" class="form-control"></div>
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
                $('#id').val('');
                $('#title').val('');
                $('#isbn').val('');
                $('#author').val('');
                $('#publisher').val('');
                $('#year_published').val('');
                $('#category').val('');

                $('#formModal').modal({
                    keyboard: false
                });
            });

            $('body').on('click', '.delete-button', function () {
                $.get({
                    url: 'delete/' + $(this).val(),
                    success: function (data) {
                        location.reload();
                    }
                })
            })

            $('body').on('click', '.edit-button', function() {
                $.get({
                    url: 'view/' + $(this).val(),
                    dataType: 'json',
                    success: function(data) {
                        $('#id').val(data.book.id);
                        $('#title').val(data.book.title);
                        $('#isbn').val(data.book.isbn);
                        $('#author').val(data.book.author);
                        $('#publisher').val(data.book.publisher);
                        $('#year_published').val(data.book.year_published);
                        $('#category').val(data.book.category);
                    }
                });
                $('#formModal').modal({
                    keyboard: false
                });
            })

            $('#form').on('submit', function(e) {
                e.preventDefault();
                const form = $(e.target);
                const json = convertFormToJSON(form);

                if (json.id != '') {
                    $.post({
                        url: 'update',
                        dataType: 'json',
                        data: json,
                        success: function(data) {
                            if (data.status == 'OK') {
                                location.reload();
                            }
                        }
                    });

                    return;
                }

                $.post({
                    url: 'create',
                    dataType: 'json',
                    data: json,
                    success: function(data) {
                        if (data.status == 'OK') {
                            location.reload();
                        }
                    }
                });
            });

            function convertFormToJSON(form) {
                const array = $(form)
                    .serializeArray(); // Encodes the set of form elements as an array of names and values.
                const json = {};
                $.each(array, function() {
                    json[this.name] = this.value || "";
                });
                return json;
            }


        });
    </script>


</body>

</html>
