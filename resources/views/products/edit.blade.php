<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laravel CRUD</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg bg-dark">

            <!--Links-->
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active text-light" aria-current="page" href="/">Products</a>
                    </li>
                    </li>
                </ul>
            </div>
        </nav>

        <!--Success Alert-->
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <div class="card mt-3 p-4">
                        <h3>Editing product {{ $product->name }}</h3>
                        <form method="POST" action="/products/{{ $product->id }}/update"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group py-3">
                                <label for="">Name</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $product->name) }}" />
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group py-3">
                                <label>Description</label>
                                <textarea type="text" name="description" class="form-control" rows="4"
                                    value="{{ old('description', $product->description) }}"></textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                            <div class="form-group py-3">
                                <label for="">Image</label>
                                <input type="file" name="image" class="form-control" value="{{ old('image') }}">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-dark">Update</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </body>

</html>
