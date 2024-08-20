@include('layouts.header')
@include('layouts.nav')
<style>
    #dropzone-file1 {
        display: none;
    }

    .label-container {
        position: relative;
        width: 144px;
        height: 144px;
        border: 2px solid #DEE2E6;
        border-radius: 8px;
        cursor: pointer;
        background-color: #F9FAFB;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background-size: cover;
        background-position: center;
    }

    .label-container img {
        display: none;
    }

    .label-container.has-image div,
    .label-container.has-image svg,
    .label-container.has-image p {
        display: none;
    }
</style>


<div class="md:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Categories')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Categories_List')</h3>

                <div>

                    <button data-modal-target="categoryModal" data-modal-toggle="categoryModal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Category')</button>
                </div>

            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Icon')</th>
                            <th class="whitespace-nowrap">@lang('lang.Category')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category_data as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="h-20 w-20">
                                        <img class="object-contain rounded-full h-full w-full bg-black  border border-blue-600"
                                            src="{{ asset($data->category_image) }}" alt="product Image">
                                    </div>
                                </td>
                                <td>{{ $data->category_name }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <a href="editCategory/{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edits.svg') }}" alt="update"></a>
                                        <a href="{{ route('deleteCategory', $data->id) }}"> <img width="38px"
                                                src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

{{-- Add Offer Modal --}}

<div id="categoryModal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full  rounded-3xl  max-w-3xl max-h-full ">
        @if (isset($categoryData))
            <form id="categoryForm" enctype="multipart/form-data" method="post"
                url="../updateCategory/{{ $categoryData->id }}">
            @else
                <form id="categoryForm" enctype="multipart/form-data" method="post" url="../addCategory">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang(!isset($categoryData) ? 'lang.Category' : 'lang.Update_Category')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="categoryModal">
                    @if (isset($categoryData))
                        <a href="../categoryList">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg></a>
                    @else
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    @endif
                </button>
            </div>


            <div class="p-5">
                <div class="flex  gap-14">

                    <div class="">@lang('lang.Icon_Image')</div>

                    <div class="flex items-center  w-full gap-14 flex-wrap">
                        <label for="dropzone-file1"
                            class="label-container flex flex-col items-center justify-center w-[144px] text-center h-[144px] border-2 border-[#DEE2E6] border-solid rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 text-center">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class=" text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">100*100</span> </p>
                            </div>
                            <input id="dropzone-file1" type="file" class="hidden" name="category_image" />
                        </label>

                    </div>
                </div>
                <div class=" flex gap-12 ps-2 mt-5 items-center">
                    <label for="category_name">@lang('lang.Category')</label>
                    <input type="text"
                        class="w-[50%] border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                        name="category_name" id="category_name" value="{{ $categoryData->category_name ?? '' }}"
                        placeholder=" @lang('lang.Category')">

                </div>
            </div>


            <div class="flex justify-end ">
                <button class="bg-primary text-white py-2 px-6 my-4 rounded-[4px]  mx-6 uaddBtn  font-semibold "
                    id="addBtn">
                    <div class=" text-center hidden" id="spinner">
                        <svg aria-hidden="true"
                            class="w-5 h-5 mx-auto text-center text-gray-200 animate-spin fill-primary"
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
                        @lang(!isset($categoryData) ? 'lang.Save' : 'lang.Update')
                    </div>

                </button>
            </div>
        </div>
        </form>
        <div>

        </div>

    </div>
</div>





@include('layouts.footer')
@if (isset($categoryData))
    <script>
        $(document).ready(function() {
            $('#categoryModal').removeClass("hidden");
            $('#categoryModal').addClass("flex");

            $('.label-container').css('background-image',
                `url('../{{ $categoryData->category_image }}')`);
            $('.label-container').addClass('has-image');

        });
    </script>
@endif
<script>
    const fileInput = document.getElementById('dropzone-file1');
    const labelContainer = document.querySelector('.label-container');

    fileInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                labelContainer.style.backgroundImage = `url(${e.target.result})`;
                labelContainer.classList.add('has-image');
            };
            reader.readAsDataURL(file);
        }
        labelContainer.addEventListener('click', function(event) {
            if (!event.target.closest('input')) {
                fileInput.click();
            }
        });
    });

    $(document).ready(function() {
        $("#categoryForm").submit(function(event) {
            let url = $('#categoryForm').attr('url');
            event.preventDefault();

            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#spinner').removeClass('hidden');
                    $('#text').addClass('hidden');
                    $('#addBtn').attr('disabled', true);
                },
                success: function(response) {
                    window.location.href = '../categoryList';

                },
                error: function(jqXHR) {
                    let response = JSON.parse(jqXHR.responseText);
                    console.log("error");
                    Swal.fire(
                        'Warning!',
                        response.message,
                        'warning'
                    );

                    $('#text').removeClass('hidden');
                    $('#spinner').addClass('hidden');
                    $('#addBtn').attr('disabled', false);
                }
            });
        });
    });
</script>
