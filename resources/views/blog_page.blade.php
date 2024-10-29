@include('layouts.header')
@include('layouts.nav')

<div class="lg:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl "> @lang(!isset($blogData) ? 'lang.Add_Blog' : 'lang.Update_Blog')</h1>
    </div>

    <div id="reloadDiv" class="shadow-dark mt-3  rounded-xl pt-8  bg-white p-10">
        @if (isset($blogData))
            <form id="blog-form" enctype="multipart/form-data" method="post" action="../updateBlog/{{ $blogData->id }}">
            @else
                <form id="blog-form" enctype="multipart/form-data" method="post" action="../addblog">
        @endif
        @csrf
        <div class="w-full  lg:gap-9 mt-5 lg:items-center flex lg:flex-row flex-col">
            <div class="lg:w-[50%] w-full">
                <label class="text-[16px] font-semibold block  text-[#452C88]"
                    for="old_password">@lang('lang.Title')</label>
                <input type="text" required
                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px] mt-2"
                    name="title" id="blog_title" placeholder=" @lang('lang.Title')" required
                    value="{{ $blogData->title ?? '' }}">
            </div>
            <div class="lg:w-[50%] w-full">
                <label class="text-[16px] font-semibold block  text-[#452C88]"
                    for="old_password">@lang('lang.Image')</label>
                <input type="file"
                    class="w-full border-[#DEE2E6] border rounded-[4px] focus:border-primary
                              h-[40px] text-[14px] mt-2"
                    name="image"{{ !isset($blogData) ? 'required' : '' }}>
            </div>

        </div>
        <div class="w-full  lg:gap-9 mt-5 lg:items-center flex lg:flex-row flex-col">
            <div class="lg:w-[50%] w-full ">

                <label for="blog_author"
                    class="text-[16px] font-semibold block  text-[#452C88]">@lang('lang.Author')</label>
                <input type="text" required
                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px] mt-2"
                    name="author" id="blog_author" placeholder=" @lang('lang.Enter_Your_Name')" required
                    value="{{ $blogData->author ?? '' }}">

            </div>
            <div class="lg:w-[50%] w-full">
                <label for="blog_category"
                    class="text-[16px] font-semibold block mb-2  text-[#452C88]">@lang('lang.Category')</label>
                <input type="text" required
                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px] mt-2"
                    name="category" id="blog_category" placeholder=" @lang('lang.Category')" required
                    value="{{ $blogData->category ?? '' }}">
            </div>
        </div>

        <div class="mt-5 relative">
            <label for="content">Content:</label>
            <div id="editor" class="">
                @php
                    if (isset($blogData->content)) {
                        echo $blogData->content;
                    }
                @endphp
            </div>
            <textarea name="content" id="content" style="display:none;"></textarea>
        </div>
        {{-- <button type="submit">Save Blog</button> --}}
        <div class="mt-10  flex justify-end">
            <button type="submit" class="bg-primary  text-white h-12 px-3 rounded-[6px]  shadow-sm font-semibold "
                id="addBtn">
                <div class=" text-center hidden" id="spinner">
                    <svg aria-hidden="true" class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-primary"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
                <div id="text">
                    @lang(!isset($blogData) ? 'lang.ADD' : 'lang.Update')
                </div>
            </button>
            </form>
        </div>
    </div>

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
                    // ['link', 'image'] // Include 'image' button in the toolbar
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

    @include('layouts.footer')
