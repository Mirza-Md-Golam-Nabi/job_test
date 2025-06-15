<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Post List</title>
</head>

<body>
    <div class="container">
        <h1>Post List</h1>
        <div>
            <a href="{{ route('home') }}" class="btn btn-sm btn-primary">Home</a>
            <a href="{{ route('post.index') }}" class="btn btn-sm btn-secondary">Pending Post</a>
            <a href="{{ route('post.accept.reject') }}" class="btn btn-sm btn-success">Accept/Reject</a>
        </div>
        @include('msg')

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="col">Tag</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $post->title }}</td>
                        <td>{{ $post->category->title }}</td>
                        <td>{{ join(', ', array_column($post->tags->toArray(), 'title')) }}</td>
                        <td><img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}"></td>
                        <td>{{ $post->status }}</td>
                        <td>
                            <a href="{{ route('post.accept', $post) }}">Accept</a> ||
                            <a href="{{ route('post.reject', $post) }}" style="color: red">Reject</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
