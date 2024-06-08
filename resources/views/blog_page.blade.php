@include('layouts.header')
@include('layouts.nav')
<style>
    #editor {
        height: 500px;
        /* Adjust the height as needed */
    }
</style>


<div class="md:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Customers')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <form action="" method="post" class="px-10 pb-5">
            <textarea name="addBlog" id="editor" class="h-[500px]"></textarea>
        </form>
    </div>
</div>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor.create(document.querySelector("#editor"), {
            ckFinder: {
                uploadURL: "",
            },
            height: 500 // Set the height in pixels
        })
        .then((editor) => {
            console.log(editor);
        })
        .catch((error) => {
            console.error(error);
        });
</script>
@include('layouts.footer')
