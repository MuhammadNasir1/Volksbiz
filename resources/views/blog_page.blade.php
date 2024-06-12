<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quill Editor</title>
    <!-- Include Quill.js from CDN -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
</head>

<body>
    {{-- <div id="editor">
            <p>Start typing...</p>
        </div>
 --}}

    <form action="save-content" method="POST" id="blog-form">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <div id="editor">
                <p>Start typing...</p>
            </div>
            <textarea name="content" id="content" style="display:none;"></textarea>
        </div>
        <button type="submit">Save Blog</button>
    </form>

    <!-- Include the Quill library -->
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <script>
        document.getElementById('blog-form').onsubmit = function() {
            // Populate the hidden textarea with the HTML content
            document.getElementById('content').value = quill.root.innerHTML;
        };
        // Initialize Quill editor with image handler
        var quill = new Quill('#editor', {
            theme: 'snow', // 'snow' is the default theme
            modules: {
                toolbar: [
                    [{
                        'header': [1, 2, 3, 4, false]
                    }],
                    ['bold', 'italic', 'underline'],
                    [{
                        'list': 'ordered'
                    }, {
                        'list': 'bullet'
                    }],
                    ['link', 'image'] // Include 'image' button in the toolbar
                ]
            }
        });

        // Listen for image inserted event
        quill.getModule('toolbar').addHandler('image', function() {
            selectLocalImage();
        });

        // Function to select local image
        function selectLocalImage() {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.click();

            // Handle file selection
            input.onchange = function() {
                var file = input.files[0];
                if (file && file.type.startsWith('image/')) {
                    uploadImage(file);
                } else {
                    console.log('Invalid file format. Please select an image.');
                }
            };
        }

        // Function to upload image
        function uploadImage(file) {
            var formData = new FormData();
            formData.append('image', file);

            fetch('{{ route('upload.image') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(result => {
                    if (result.url) {
                        insertToEditor(result.url);
                    } else {
                        console.error('Failed to upload image');
                    }
                })
                .catch(error => {
                    console.error('Error uploading image:', error);
                });
        }

        // Function to insert image into the editor
        function insertToEditor(url) {
            var range = quill.getSelection();
            quill.insertEmbed(range.index, 'image', url, Quill.sources.USER);
        }
    </script>
</body>

</html>
