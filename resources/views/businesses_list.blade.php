@extends('layouts.layout')

@section('title')
    Business
@endsection

@section('content')
    <div class="md:mx-4 mt-12">
        <div>
            <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Offers')</h1>
        </div>
        <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
            <div>
                <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                    <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Offers_List')</h3>

                    <div>

                        <button id="addModalBtn" data-modal-target="business-modal" data-modal-toggle="business-modal"
                            class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                            @lang('lang.Add_Business')</button>
                    </div>

                </div>
                @php
                    $headers = [
                        __('lang.Sr'),
                        __('lang.Image'),
                        __('lang.Title'),
                        __('lang.Price'),
                        __('lang.Category'),
                        __('lang.Location'),
                        __('lang.Action'),
                    ];
                @endphp
                <x-table :headers="$headers">
                    <x-slot name="tablebody">
                        @foreach ($bussinesses as $bussiness)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @php
                                        $images = json_decode($bussiness->images, true);
                                    @endphp


                                    <div class="h-20 w-20">
                                        <img class="object-contain rounded-full h-full w-full bg-black  border border-primary"
                                            src="{{ isset($images[0]) && !empty($images) ? asset($images[0]) : asset('images/default-logo.png') }}"
                                            alt="No Image ">
                                    </div>
                                </td>
                                <td>{{ $bussiness->title }}</td>
                                <td>{{ $bussiness->price }}</td>
                                <td>{{ $bussiness->category }}</td>
                                <td>{{ $bussiness->city }} {{ $bussiness->country }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">
                                        <button data-modal-target="updatecustomermodal"
                                            data-modal-toggle="updatecustomermodal" data-id="{{ $bussiness->id }}"
                                            class="cursor-pointer view-button">
                                            <img width="38px" src="{{ asset('images/icons/views.svg') }}" alt="View">
                                        </button>

                                        <a href="../bussinesses-update/{{ $bussiness->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edits.svg') }}" alt="update"></a>
                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="hidden"></button>

                                        <button class="deleteDataBtn" delUrl="bussinessesDel/{{ $bussiness->id }}">
                                            <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                                xmlns='http://www.w3.org/2000/svg'>
                                                <circle opacity='0.1' cx='18' cy='18' r='18'
                                                    fill='#DF6F79' />
                                                <path fill-rule='evenodd' clip-rule='evenodd'
                                                    d='M23.4905 13.7423C23.7356 13.7423 23.9396 13.9458 23.9396 14.2047V14.4441C23.9396 14.6967 23.7356 14.9065 23.4905 14.9065H13.0493C12.8036 14.9065 12.5996 14.6967 12.5996 14.4441V14.2047C12.5996 13.9458 12.8036 13.7423 13.0493 13.7423H14.8862C15.2594 13.7423 15.5841 13.4771 15.6681 13.1028L15.7642 12.6732C15.9137 12.0879 16.4058 11.6992 16.9688 11.6992H19.5704C20.1273 11.6992 20.6249 12.0879 20.7688 12.6423L20.8718 13.1022C20.9551 13.4771 21.2798 13.7423 21.6536 13.7423H23.4905ZM22.557 22.4932C22.7487 20.7059 23.0845 16.4598 23.0845 16.4169C23.0968 16.2871 23.0545 16.1643 22.9705 16.0654C22.8805 15.9728 22.7665 15.918 22.6409 15.918H13.9025C13.7762 15.918 13.6562 15.9728 13.5728 16.0654C13.4883 16.1643 13.4466 16.2871 13.4527 16.4169C13.4539 16.4248 13.4659 16.5744 13.4861 16.8244C13.5755 17.9353 13.8248 21.0292 13.9858 22.4932C14.0998 23.5718 14.8074 24.2496 15.8325 24.2742C16.6235 24.2925 17.4384 24.2988 18.2717 24.2988C19.0566 24.2988 19.8537 24.2925 20.6692 24.2742C21.7298 24.2559 22.4369 23.59 22.557 22.4932Z'
                                                    fill='#D11A2A' />
                                            </svg>
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>


            </div>
        </div>
    </div>

    {{-- Add Offer Modal --}}
    <x-modal id="business-modal">
        <x-slot name="title">Add Business</x-slot>
        <x-slot name="modal_width">max-w-6xl</x-slot>
        <x-slot name="body">
            <form id="postDataForm" url="addBusiness" method="post">
                @csrf
                <div class="grid grid-cols-3 gap-4">
                    <div class="flex gap-4 col-span-3">
                        <x-file-uploader id="businessImage1" name="bus_img1" title="Upload business Image 1"
                            requirements="SVG, PNG or JPG (MAX. 600x600px)"></x-file-uploader>
                        <x-file-uploader id="businessImage2" name="bus_img2" title="Upload business Image 2"
                            requirements="SVG, PNG or JPG (MAX. 600x600px)"></x-file-uploader>
                        <x-file-uploader id="businessImage3" name="bus_img3" title="Upload business Image 3"
                            requirements="SVG, PNG or JPG (MAX. 600x600px)"></x-file-uploader>
                        <x-file-uploader id="businessImage4" name="bus_img4" title="Upload business Image 4"
                            requirements="SVG, PNG or JPG (MAX. 600x600px)"></x-file-uploader>
                    </div>
                    <div class="col-span-3 grid grid-cols-2 gap-4 mt-4">
                        <x-file-uploader id="video" name="video" title="Upload business video"
                            requirements="Mp4 (MAX. 1080x1920px)"></x-file-uploader>
                        <div>
                            <ul class="list-disc list-inside">
                                <li class="text-sm">Lorem ipsum dolor sit a met consectetur adipisicing elit. Enim, debitis?
                                </li>
                                <li class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, debitis?
                                </li>
                                <li class="text-sm">Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, debitis?
                                </li>
                            </ul>
                        </div>
                    </div>

                    <x-input id="titleEn" label="{{ __('lang.Title') }}(EN)"
                        placeholder="{{ __('lang.Title_In_English') }}" name='title' type="text"></x-input>
                    <x-input id="titleDe" label="{{ __('lang.Title') }}(De)"
                        placeholder="{{ __('lang.Title_In_German') }}" name='title_de' type="text"></x-input>
                    <x-select id="categoryNameDe" label="{{ __('lang.Category') }}" name='category'>
                        <x-slot name="options">
                            <option selected disabled> @lang('lang.Select_Category')</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"> {{ $category->category_name }} /
                                    {{ $category->category_name_de }}
                                </option>
                            @endforeach
                        </x-slot>

                    </x-select>
                    <x-input id="price" label="{{ __('lang.Price') }}(€)" placeholder="{{ __('lang.Enter_price') }}"
                        name='price' type="text"></x-input>
                    {{-- <x-select id="categoryNameDe" label="{{ __('lang.Category') }}(DE)" name='name_en'>
                    <x-slot name="options">
                        <option selected disabled>@lang('lang.Select_Category')</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name_de }} </option>
                        @endforeach
                    </x-slot>
                </x-select> --}}
                    <x-select id="country" label="{{ __('lang.Country') }}" name='country'>
                        <x-slot name="options">
                            <option selected disabled> @lang('lang.Select_Country')</option>
                            @include('includes.countrieslist')
                        </x-slot>
                    </x-select>
                    <x-input id="city" label="{{ __('lang.City') }}" placeholder="{{ __('lang.Enter_City') }}"
                        name='city' type="text"></x-input>
                    <div class="col-span-3 grid grid-cols-2 gap-4">
                        <x-textarea id="infoEn" label="{{ __('lang.info') }}(EN)"
                            placeholder="{{ __('lang.Info_In_English') }}" name='description'></x-textarea>
                        <x-textarea id="infoEn" label="{{ __('lang.info') }}(De)"
                            placeholder="{{ __('lang.Info_In_German') }}" name='description_de'></x-textarea>
                    </div>


                </div>
                <div class="mt-6">

                    <x-modal-button title="Add"></x-modal-button>
                </div>
            </form>
        </x-slot>
    </x-modal>








    <div id="updatecustomermodal"
        class="fixed inset-0 z-50 overflow-y-scroll hidden flex items-center justify-center bg-black bg-opacity-50">
        <div class="fixed inset-0 transition-opacity">
            <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
        </div>
        <div class="relative p-4 w-full max-w-6xl max-h-full">
            <form id="UpdatecustomerData" method="post" enctype="multipart/form-data">
                @csrf
                <div class="relative bg-white shadow-dark rounded-lg dark:bg-gray-700">
                    <div class="flex items-center justify-between p-5 rounded-t bg-primary">
                        <h3 class="text-xl font-semibold text-white">
                            @lang('lang.Details')
                        </h3>
                        <button type="button" class="text-white bg-transparent rounded-lg text-sm w-8 h-8"
                            data-modal-hide="updatecustomermodal">
                            <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex p-5 w-full lg:flex-row flex-col">
                        <div class="flex gap-4 lg:w-[50%] w-full lg:justify-start justify-center">
                            <div class="video-container flex flex-col py-7">
                                <div class="first-image">
                                    <img src="" alt="" class="h-[250px] w-[300px]">
                                </div>
                                <div class="flex gap-3 py-3 flex-wrap">
                                    <div class="images flex gap-3 py-3 flex-wrap">
                                        <!-- Last three images will be appended here -->
                                    </div>
                                    <video src="" controls loop class="h-[116px] mt-3 w-[116px]"
                                        id="videoTag"></video>
                                </div>
                            </div>
                        </div>
                        <div class="px-5 py-7 w-full lg:w-[50%]">
                            <h1 class="text-4xl font-bold">@lang('lang.Title')</h1>
                            <div class="h-1 bg-black w-40 mt-3"></div>
                            <div class="flex gap-10 pt-7">
                                <h5 class="font-bold">@lang('lang.Category') :</h5>
                                <p class="category"></p>
                            </div>
                            <div class="flex gap-12 pt-3">
                                <h5 class="font-bold">@lang('lang.Location') :</h5>
                                <p class="location"></p>
                            </div>
                            <div class="flex gap-20 pt-3">
                                <h5 class="font-bold">@lang('lang.Date') :</h5>
                                <p class="date"></p>
                            </div>
                            <div class="flex gap-6 pt-3">
                                <h5 class="font-bold text-nowrap">
                                    @lang('lang.Description') :</h5>
                                <p class="text-justify description break-words"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function updateDatafun() {

            $('.updateDataBtn').click(function() {
                $('#business-modal').removeClass("hidden");
                $('#business-modal').addClass('flex');

                $('#postDataForm').attr('url', 'updateCategory/' + $(this).attr('CategoryId'));


                $('#categoryNameEn').val($(this).attr('nameEn'));
                $('#categoryNameDe').val($(this).attr('nameDe'));
                let fileImg = $('#business-modal .file-preview');
                fileImg.removeClass('hidden').attr('src', $(this).attr('image'));

                $('#business-modal #modalTitle').text("Edit Category");
                $('#business-modal #submitBtn').text("Update");

            });
        }
        updateDatafun();
        // $('#addModalBtn').click(function() {
        //     $('#postDataForm')[0].reset();
        //     $('#postDataForm').attr('url', 'addCategory');
        //     let fileImg = $('#business-modal .file-preview');
        //     fileImg.addClass('hidden');
        //     $('#business-modal #modalTitle').text("Add Category");
        //     $('#business-modal #submitBtn').text("Add");

        // })
        // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            console.log(response);

            if (response.success) {
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
