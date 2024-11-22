@extends('layouts.layout')

@section('title')
    Business
@endsection

@section('content')
<button data-modal-target="business-detail-modal"data-modal-toggle="business-detail-modal"></button>
    <div class="md:mx-4 mt-12">
        <div>
            <h1 class=" font-semibold   text-2xl ">All Businesses</h1>
        </div>
        <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
            <div>
                <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                    <h3 class="text-[20px] text-black hidden sm:block">Businesses List</h3>

                    <div>

                        <button id="addModalBtn" data-modal-target="business-modal" data-modal-toggle="business-modal"
                            class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                            @lang('lang.Add_Business')</button>
                            <button data-modal-target="change-status-modal" data-modal-toggle="change-status-modal"></button>
                    </div>

                </div>
                @php
                    $headers = [
                        __('lang.Sr'),
                        __('lang.Image'),
                        "User Name / Phone No",
                        __('lang.Title'),
                        __('lang.Price'),
                        __('lang.Category'),
                        __('lang.Location'),
                        __('lang.Status'),
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
                                        $user =  \App\Models\User::select('name', 'role')->where('id', $bussiness->user_id)->first()
                                    @endphp


                                    <div class="h-20 w-20">
                                        <img class="object-cover rounded-full h-full w-full bg-black  border border-primary"
                                            src="{{ isset($images[0]) && !empty($images) ? asset($images[0]) : asset('images/default-logo.png') }}"
                                            alt="No Image ">
                                    </div>
                                </td>
                                <td>  {{ $user->name }} / <a href="tel:{{ $bussiness->phone_no }}" class="text-blue-700">{{ $bussiness->phone_no }}</a> <span class="text-xs text-red-800">{{ $user->role == "admin" ? "(Admin)" : "" }}</span></td>
                                <td>{{ $bussiness->title }}</td>
                                <td>{{ $bussiness->price }}&euro;</td>
                                <td>{{ $bussiness->category }} / {{ $bussiness->category_de }}</td>
                                <td>{{ $bussiness->city }} {{ $bussiness->country }}</td>
                                <td><button updateId={{$bussiness->id}}  class="{{$bussiness->status !== "sold" ? 'updateStatus' : ''}}">
                                    <span class="{{  $bussiness->status == 'active' ? 'text-green-800' : ($bussiness->status == 'sold' ? 'text-purple-800' : 'text-red-700') }} font-semibold text-sm">
                                        {{ ucfirst($bussiness->status) }}
                                    </span>
                                    </button></td>
                                    
                                <td>
                                    <div class="flex gap-5 items-center">
                                        
                                        <button data-modal-target="business-detail-modal"
                                        url="../singleBusinesses/{{ $bussiness->id }}"
                                            data-modal-toggle="business-detail-modal" data-id="{{ $bussiness->id }}"
                                            class="cursor-pointer view-button getDataBtn">
                                            <svg width="36" height="36" viewBox="0 0 36 36" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle cx="18" cy="18" r="18" fill="#323C47"
                                                    fill-opacity="0.1" />
                                                <path
                                                    d="M17.75 15.3977C16.9724 15.3977 16.2267 15.7066 15.6769 16.2564C15.1271 16.8063 14.8182 17.552 14.8182 18.3295C14.8182 19.1071 15.1271 19.8528 15.6769 20.4027C16.2267 20.9525 16.9724 21.2614 17.75 21.2614C18.5276 21.2614 19.2733 20.9525 19.8231 20.4027C20.3729 19.8528 20.6818 19.1071 20.6818 18.3295C20.6818 17.552 20.3729 16.8063 19.8231 16.2564C19.2733 15.7066 18.5276 15.3977 17.75 15.3977ZM17.75 23.2159C16.4541 23.2159 15.2112 22.7011 14.2948 21.7847C13.3784 20.8684 12.8636 19.6255 12.8636 18.3295C12.8636 17.0336 13.3784 15.7907 14.2948 14.8744C15.2112 13.958 16.4541 13.4432 17.75 13.4432C19.0459 13.4432 20.2888 13.958 21.2052 14.8744C22.1216 15.7907 22.6364 17.0336 22.6364 18.3295C22.6364 19.6255 22.1216 20.8684 21.2052 21.7847C20.2888 22.7011 19.0459 23.2159 17.75 23.2159ZM17.75 11C12.8636 11 8.69068 14.0393 7 18.3295C8.69068 22.6198 12.8636 25.6591 17.75 25.6591C22.6364 25.6591 26.8093 22.6198 28.5 18.3295C26.8093 14.0393 22.6364 11 17.75 11Z"
                                                    fill="#339B96" />
                                            </svg>

                                        </button>
                                        @if ($bussiness->status !== "sold")
                                        <button class="updateDataBtn" url="../singleBusinesses/{{ $bussiness->id }}"
                                            nameEn="{{ $bussiness->title }}" nameDe="{{ $bussiness->title_de }}"
                                            category="{{ $bussiness->category_id }}" price="{{ $bussiness->price }}"
                                            country="{{ $bussiness->country }}" city="{{ $bussiness->city }}"
                                            infoDe="{{ $bussiness->description }}"
                                            infoEn="{{ $bussiness->description }}" images="{{ $bussiness->images }}"
                                            video="{{ $bussiness->video }}"
                                            updateUrl="updateBusinessData/{{ $bussiness->id }}">
                                            <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                                xmlns='http://www.w3.org/2000/svg'>
                                                <circle opacity='0.1' cx='18' cy='18' r='18'
                                                    fill='#233A85' />
                                                <path fill-rule='evenodd' clip-rule='evenodd'
                                                    d='M16.1637 23.6188L22.3141 15.665C22.6484 15.2361 22.7673 14.7402 22.6558 14.2353C22.5593 13.7763 22.277 13.3399 21.8536 13.0088L20.8211 12.1886C19.9223 11.4737 18.8081 11.549 18.1693 12.3692L17.4784 13.2654C17.3893 13.3775 17.4116 13.543 17.523 13.6333C17.523 13.6333 19.2686 15.0329 19.3058 15.063C19.4246 15.1759 19.5137 15.3264 19.536 15.507C19.5732 15.8607 19.328 16.1918 18.9641 16.2369C18.7932 16.2595 18.6298 16.2068 18.511 16.109L16.6762 14.6492C16.5871 14.5822 16.4534 14.5965 16.3791 14.6868L12.0188 20.3304C11.7365 20.6841 11.64 21.1431 11.7365 21.5871L12.2936 24.0025C12.3233 24.1304 12.4348 24.2207 12.5685 24.2207L15.0197 24.1906C15.4654 24.1831 15.8814 23.9799 16.1637 23.6188ZM19.5958 22.8672H23.5929C23.9829 22.8672 24.3 23.1885 24.3 23.5835C24.3 23.9794 23.9829 24.2999 23.5929 24.2999H19.5958C19.2059 24.2999 18.8887 23.9794 18.8887 23.5835C18.8887 23.1885 19.2059 22.8672 19.5958 22.8672Z'
                                                    fill='#233A85' />
                                            </svg>
                                        </button>
                                        
                                        
                                        <button class="deleteDataBtn" delUrl="deleteBusiness/{{ $bussiness->id }}">
                                            <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                            xmlns='http://www.w3.org/2000/svg'>
                                            <circle opacity='0.1' cx='18' cy='18' r='18'
                                            fill='#DF6F79' />
                                            <path fill-rule='evenodd' clip-rule='evenodd'
                                            d='M23.4905 13.7423C23.7356 13.7423 23.9396 13.9458 23.9396 14.2047V14.4441C23.9396 14.6967 23.7356 14.9065 23.4905 14.9065H13.0493C12.8036 14.9065 12.5996 14.6967 12.5996 14.4441V14.2047C12.5996 13.9458 12.8036 13.7423 13.0493 13.7423H14.8862C15.2594 13.7423 15.5841 13.4771 15.6681 13.1028L15.7642 12.6732C15.9137 12.0879 16.4058 11.6992 16.9688 11.6992H19.5704C20.1273 11.6992 20.6249 12.0879 20.7688 12.6423L20.8718 13.1022C20.9551 13.4771 21.2798 13.7423 21.6536 13.7423H23.4905ZM22.557 22.4932C22.7487 20.7059 23.0845 16.4598 23.0845 16.4169C23.0968 16.2871 23.0545 16.1643 22.9705 16.0654C22.8805 15.9728 22.7665 15.918 22.6409 15.918H13.9025C13.7762 15.918 13.6562 15.9728 13.5728 16.0654C13.4883 16.1643 13.4466 16.2871 13.4527 16.4169C13.4539 16.4248 13.4659 16.5744 13.4861 16.8244C13.5755 17.9353 13.8248 21.0292 13.9858 22.4932C14.0998 23.5718 14.8074 24.2496 15.8325 24.2742C16.6235 24.2925 17.4384 24.2988 18.2717 24.2988C19.0566 24.2988 19.8537 24.2925 20.6692 24.2742C21.7298 24.2559 22.4369 23.59 22.557 22.4932Z'
                                            fill='#D11A2A' />
                                        </svg>
                                    </button>
                                    @endif

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
                        <div class="relative flex items-center justify-center w-full h-full" id="VideoUploader">
                            <label
                                class="file-upload-label flex flex-col items-center justify-center w-full h-full border-2 border-gray-300 border-dashed rounded-md cursor-pointer bg-gray-50">
                                <div class="file-upload-content flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                            class="font-semibold">Upload business video</span>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Mp4 (MAX. 1080x1920px)</p>
                                </div>
                                <input type="file" class="file-input hidden" name="video"
                                    onchange="previewFile(event)" id="videoLabel" />
                                <video
                                    class="file-preview absolute top-0 left-0 w-full h-full object-contain hidden  bg-black rounded-lg"
                                    controls autoplay muted accept="video/*"></video>
                            </label>
                        </div>
                        <div>
                            <ul class="list-disc list-inside">
                                <li class="text-sm">Lorem ipsum dolor sit a met consectetur adipisicing elit. Enim,
                                    debitis?
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
                    <x-input id="price" label="{{ __('lang.Price') }}(€)"
                        placeholder="{{ __('lang.Enter_price') }}" name='price' type="text"></x-input>
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
                        <x-textarea id="infoDe" label="{{ __('lang.info') }}(De)"
                            placeholder="{{ __('lang.Info_In_German') }}" name='description_de'></x-textarea>
                    </div>


                </div>
                <div class="mt-6">

                    <x-modal-button title="Add"></x-modal-button>
                </div>
            </form>
        </x-slot>
    </x-modal>







    <x-modal id="business-detail-modal">
        <x-slot name="title">@lang('lang.Details')</x-slot>
        <x-slot name="modal_width">max-w-6xl</x-slot>
        <x-slot name="body">
            <div class="modal-loading hidden">
                <div class=" text-center h-[400px] w-full flex justify-center items-center  ">
                    <svg aria-hidden="true" class="w-12 h-12 mx-auto text-center text-gray animate-spin fill-primary"
                        viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                            fill="currentColor" />
                        <path
                            d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                            fill="currentFill" />
                    </svg>
                </div>
            </div>
            <div class="flex p-5 w-full lg:flex-row flex-col modal-content ">
                <div class="flex gap-4 lg:w-[50%] w-full lg:justify-start justify-center">
                    <div class="video-container flex flex-col py-7">
                        <div class="first-image">
                            <img id="dimage-1" src="" alt=""
                                class="h-[250px] w-[300px] object-contain bg-black">
                        </div>
                        <div class="flex gap-3 py-3 flex-wrap">
                            <div class="images flex gap-3 py-3 " id="image-container">
                                <!-- Last three images will be appended here -->
                            </div>
                            <video src="" controls class="h-[130px] mt-3 w-[140px]" id="videoTag"></video>
                        </div>
                    </div>
                </div>
                <div class="px-5 py-7 w-full lg:w-[50%]">
                    <h1 class="text-4xl font-bold">@lang('lang.Details')</h1>
                    <div class="h-1 bg-black w-40 mt-3"></div>
                    <div class="flex gap-20 pt-7">
                        <h5 class="font-bold text-nowrap">
                            @lang('lang.Title') :</h5>
                        <p class="text-justify break-words" id="dTitle"></p>
                    </div>
                    <div class="flex gap-10 pt-3">
                        <h5 class="font-bold">@lang('lang.Category') :</h5>
                        <p class="category" id="dCategory"></p>
                    </div>
                    <div class="flex gap-12 pt-3">
                        <h5 class="font-bold">@lang('lang.Location') :</h5>
                        <p class="location" id="dLocation"></p>
                    </div>
                    <div class="flex gap-20 pt-3">
                        <h5 class="font-bold">@lang('lang.Date') :</h5>
                        <p class="date" id='Date'></p>
                    </div>
                    <div class="flex gap-6 pt-3">
                        <h5 class="font-bold text-nowrap">
                            @lang('lang.Description') :</h5>
                        <p class="text-justify description break-words" id="dDescription"></p>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-modal>

    {{-- change status modal --}}
    <x-modal id="change-status-modal">
        <x-slot name="title">@lang('lang.Details')</x-slot>
        <x-slot name="modal_width">max-w-2xl</x-slot>
        <x-slot name="body">
            <form id="changeStatus"  url="changeBusinessStatus" method="post">
                @csrf
                <input type="hidden" id="updateStatusId" name="update_id">
                <div>
                    <x-select id="status" label="{{ __('lang.Status') }}" name='status'>
                        <x-slot name="options">
                            <option selected disabled> @lang('lang.Select_Status')</option>
                            <option value="sold" >Sold</option>
                            <option value="active">Active</option>
                            <option value="reserved">Reserved</option>

                        </x-slot>
                    </x-select>
                    <div class="mt-6">

                        <button class="w-full px-3 py-2 font-semibold text-white rounded-lg shadow-md bg-primary" id="CsubmitBtn">
                            <div id="CbtnSpinner" class="hidden">
                                <svg aria-hidden="true" class="w-6 h-6 mx-auto text-center text-gray-200 animate-spin fill-white"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                            </div>
                            <div id="CbtnText">
                           Change Status
                            </div>
                        </button>
                       
                    </div>
                </div>
            </form>
        </x-slot>
    </x-modal>
@endsection
@section('js')
    <script>
        
        function getData() {
            $(".updateStatus").click(function() {
                $('#change-status-modal').addClass('flex').removeClass('hidden');
                $('#updateStatusId').val($(this).attr('updateid'));
            });
            $(".getDataBtn").click(function() {
                $('#business-detail-modal').removeClass('hidden').addClass('flex')
                let url = $(this).attr("url");
                $.ajax({
                    type: "GET",
                    url: url,
                    // url: url,
                    beforeSend: function() {
                        $(".modal-loading").removeClass("hidden");
                        $(".modal-content").addClass("hidden");
                    },
                    success: function(response) {
                        $(".modal-loading").addClass("hidden");
                        $(".modal-content").removeClass("hidden");
                        $('#dCategory').text('');
                        $('#dLocation').text('');
                        $('#Date').text('');
                        $('#dDescription').text('');
                        $('#dTitle').text('');
                        $('#videoTag').attr('src', '');
                        $('#dimage-1').attr('src', './images/compnay-logo.svg');
                        const $imageContainer = $('#image-container');
                        $imageContainer.empty();
                        if (response.success) {
                            let data = response.data;
                            $('#dCategory').text(data.category + "/" + data.category_de)
                            $('#dLocation').text(data.city + "/" + data.country)
                            $('#Date').text(data.date)
                            $('#dDescription').text(data.description)
                            $('#dTitle').text(data.title)

                            if (data.video !== "null" || data.video !== null) {
                                $('#videoTag').removeClass('hidden');
                                $('#videoTag').attr('src', data.video)
                            } else {
                                $('#videoTag').addClass('hidden');

                            }
                            $('#dimage-1').attr('src', data.images[0])
                            const $imageContainer = $('#image-container');

                            $('#dimage-1').attr('src', data.images[0]);
                            data.images.forEach((src, index) => {
                                // Create an img element
                                const $img = $('<img>').attr('src', src).attr('id',
                                    `dimage-${index + 1}`).attr(
                                    'class',
                                    'h-[116px] mt-3 w-[116px] object-contain bg-black ');
                                $imageContainer.append($img);
                            });
                        } else {


                        }
                    },
                    error: function(jqXHR) {
                        let response = JSON.parse(jqXHR.responseText);

                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: "Error",
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000,
                        });
                        $(".modal-loading").removeClass("hidden");
                        $(".modal-content").addClass("hidden");
                    },
                });
            });

        }
        getData()
        $(".dataTable").on("draw", function () {
    
        getData()
    });
        $('#VideoUploader .file-preview').click(function() {
            $('#videoLabel').click();

        })

        function updateDatafun() {
            $('.updateDataBtn').click(function() {
                $('#business-modal').removeClass("hidden");
                $('#business-modal').addClass('flex');

                $('#postDataForm').attr('url', $(this).attr('updateUrl'));


                $('#titleEn').val($(this).attr('nameEn'));
                $('#titleDe').val($(this).attr('nameDe'));
                $('#categoryNameDe').val($(this).attr('category')).trigger('change');
                $('#price').val($(this).attr('price'));
                $('#country').val($(this).attr('country')).trigger('change');
                $('#city').val($(this).attr('city'));
                $('#infoEn').val($(this).attr('infoEn'));
                $('#infoDe').val($(this).attr('infoDe'));
                let fileImg = $('#business-modal .file-preview');
                fileImg.addClass('hidden');
                const videoUrl = $(this).attr('video');
                if (videoUrl && videoUrl !== null) {
                    $('#VideoUploader .file-preview').attr('src', $(this).attr('video')).removeClass('hidden');
                } else {
                    $('#VideoUploader .file-preview').addClass('hidden');
                }

                $('#business-modal #modalTitle').text("Edit Category");
                $('#business-modal #submitBtn').text("Update");

                let jsonString = $(this).attr('images');
                const imageArray = JSON.parse(jsonString);
                imageArray.forEach((imageUrl, index) => {
                    const uploaderId = `#businessImage${index + 1}`;
                    let tag = `${uploaderId} .file-preview`;
                    $(tag).attr('src', imageUrl).removeClass('hidden');


                });

            });
        }
        updateDatafun();
        $('#addModalBtn').click(function() {
            $('#postDataForm')[0].reset();
            $('#postDataForm').attr('url', 'addBusiness');
            let fileImg = $('#business-modal .file-preview');
            fileImg.addClass('hidden');
            $('#business-modal #modalTitle').text("Add Business");
            $('#business-modal #submitBtn').text("Add");

        })

        $("#changeStatus").submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                // Send the AJAX request
                $.ajax({
                    type: "POST",
                    url: "/changeBusinessStatus",
                    data: formData,
                    dataType: "json",
                    beforeSend: function() {
                        $('#Cspinner').removeClass('hidden');
                        $('#Ctext').addClass('hidden');
                        $('#Cloginbutton').attr('disabled', true);
                    },
                    success: function(response) {
                        // Handle the success response here
                        if (response.success == true) {
                            $('#Ctext').removeClass('hidden');
                            $('#Cspinner').addClass('hidden');

                            window.location.href = '../businesses';

                        } else if (response.success == false) {
                            Swal.fire(
                                'Warning!',
                                response.message,
                                'warning'
                            )
                        }
                    },
                    error: function(jqXHR) {

                        let response = JSON.parse(jqXHR.responseText);

                        Swal.fire(
                            'Warning!',
                            response.message,
                            'warning'
                        )
                        $('#Ctext').removeClass('hidden');
                        $('#Cspinner').addClass('hidden');
                        $('#Cloginbutton').attr('disabled', false);
                    }
                });
            });

        // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            if (response.success) {
                getData()
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
