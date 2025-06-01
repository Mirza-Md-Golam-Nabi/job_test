<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://richtexteditor.com/richtexteditor/rte_theme_default.css" />
    <script type="text/javascript" src="https://richtexteditor.com/richtexteditor/rte.js"></script>
    <script type="text/javascript" src='https://richtexteditor.com/richtexteditor/plugins/all_plugins.js'></script>

    <title>Hello, world!</title>
</head>

<body>
    <div class="container">
        <h1>Create Post</h1>
        @include('msg')

        <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title <span class></span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    value="{{ old('title') }}" name="title" placeholder="Enter title" required>
                @error('title')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category" name="category_id"
                    required>
                    <option>Please Select One</option>
                    @forelse ($categories as $key => $value)
                        @if (old('category_id') == $key)
                            <option value={{ $key }} selected>{{ $value }}</option>
                        @else
                            <option value={{ $key }}>{{ $value }}</option>
                        @endif
                    @empty
                        <option value="">Three is no data!</option>
                    @endforelse
                </select>
                @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="div_editor1">
                    @if (old('description'))
{!! old('description') !!}
@else
{{ 'Post description details' }}
@endif
                </textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" accept="image/jpeg,image/png">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tag" class="form-label">Tag</label>
                <select class="form-select @error('tag') is-invalid @enderror" id="tag" name="tag_id">
                    <option>Please Select One</option>
                    @forelse ($tags as $key => $value)
                        @if (old('tag_id') == $key)
                            <option value={{ $key }} selected>{{ $value }}</option>
                        @else
                            <option value={{ $key }}>{{ $value }}</option>
                        @endif
                    @empty
                        <option value="">Three is no data!</option>
                    @endforelse
                </select>
                @error('tag_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script>
        var editor1 = new RichTextEditor("#div_editor1");
        //editor1.setHTMLCode("Use inline HTML or setHTMLCode to init the default content.");
    </script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</body>

</html>
