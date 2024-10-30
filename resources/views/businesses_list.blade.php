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
        <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Offers')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Offers_List')</h3>

                <div>

                    <button data-modal-target="addcustomermodal" data-modal-toggle="addcustomermodal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Business')</button>
                </div>

            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Image')</th>
                            <th class="whitespace-nowrap">@lang('lang.Title')</th>
                            <th class="whitespace-nowrap">@lang('lang.Price')</th>
                            <th class="whitespace-nowrap">@lang('lang.Category')</th>
                            <th class="whitespace-nowrap">@lang('lang.Location')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bussinesses as $bussiness)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @php
                                        $images = json_decode($bussiness->images);
                                    @endphp

                                    @if (!empty($images) && isset($images[0]))
                                        <img src="{{ asset($images[0]) }}" alt="Business Image"
                                            class="size-[150px] object-contain">
                                    @else
                                        <img src="{{ asset('images/default-placeholder.png') }}"
                                            alt="No Image Available" width="250px">
                                    @endif
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
                                            <img width="38px" src="{{ asset('images/icons/views.svg') }}"
                                                alt="View">
                                        </button>

                                        <a href="../bussinesses-update/{{ $bussiness->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edits.svg') }}" alt="update"></a>
                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="hidden"></button>
                                        <button class="delButton" delId="{{ $bussiness->id }}">
                                            <svg class="h-[40px] w-[40px]" viewBox="0 0 36 36" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <circle opacity="0.1" cx="18" cy="18" r="18"
                                                    fill="#DF6F79" />
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M23.4905 13.7433C23.7356 13.7433 23.9396 13.9468 23.9396 14.2057V14.4451C23.9396 14.6977 23.7356 14.9075 23.4905 14.9075H13.0493C12.8036 14.9075 12.5996 14.6977 12.5996 14.4451V14.2057C12.5996 13.9468 12.8036 13.7433 13.0493 13.7433H14.8862C15.2594 13.7433 15.5841 13.478 15.6681 13.1038L15.7642 12.6742C15.9137 12.0889 16.4058 11.7002 16.9688 11.7002H19.5704C20.1273 11.7002 20.6249 12.0889 20.7688 12.6433L20.8718 13.1032C20.9551 13.478 21.2798 13.7433 21.6536 13.7433H23.4905ZM22.5573 22.4946C22.7491 20.7073 23.0849 16.4611 23.0849 16.4183C23.0971 16.2885 23.0548 16.1656 22.9709 16.0667C22.8808 15.9741 22.7669 15.9193 22.6412 15.9193H13.9028C13.7766 15.9193 13.6565 15.9741 13.5732 16.0667C13.4886 16.1656 13.447 16.2885 13.4531 16.4183C13.4542 16.4261 13.4663 16.5757 13.4864 16.8258C13.5759 17.9366 13.8251 21.0305 13.9861 22.4946C14.1001 23.5731 14.8078 24.251 15.8328 24.2756C16.6238 24.2938 17.4387 24.3001 18.272 24.3001C19.0569 24.3001 19.854 24.2938 20.6696 24.2756C21.7302 24.2573 22.4372 23.5914 22.5573 22.4946Z"
                                                    fill="#D11A2A" />
                                            </svg>

                                        </button>

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

<div id="addcustomermodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="fixed inset-0 transition-opacity">
        <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
    </div>
    <div class="relative p-4 w-full  rounded-3xl  max-w-6xl max-h-full ">
        @if (isset($buissnessData))
            <form id="buissnessForm" url="../updateBusinessData/{{ $buissnessData->id }}" method="post"
                enctype="multipart/form-data">
            @else
                <form action="../addBusiness" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang(!isset($buissnessData) ? 'lang.New_Business' : 'lang.Update_Business')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="addcustomermodal">
                    @if (isset($buissnessData))
                        @php
                            $image = json_decode($bussiness->images);
                        @endphp
                        <a href="../businesses">
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

                    <div class="">@lang('lang.Images')</div>

                    <div class="flex items-center  w-full gap-14 flex-wrap">

                        <!-- Upload and Preview Container 1 -->
                        <label for="dropzone-file1"
                            class="label-container flex flex-col items-center justify-center w-[144px] text-center h-[144px] border-2 border-[#DEE2E6] border-solid rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                            style="background-image: url('{{ isset($buissnessData) && isset($image[0]) ? asset($image[0]) : '' }}')">
                            <img id="preview1"
                                class="absolute inset-0 w-full h-full object-cover hidden bg-gray-100 dark:bg-gray-700 rounded-lg" />
                            <div class="flex flex-col items-center justify-center pt-5 text-center {{ isset($buissnessData) && isset($image[0]) ? 'hidden' : '' }}"
                                id="label-container1">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center"><span
                                        class="font-semibold">Upload</span> <br> <span>100*100</span></p>
                            </div>
                            <input id="dropzone-file1" type="file" class="hidden" name="bus_img1"
                                value="{{ isset($buissnessData) && isset($image[0]) ? $image[0] : '' }}"
                                accept="image/*" />
                        </label>

                        <!-- Upload and Preview Container 2 -->
                        <label for="dropzone-file2"
                            class="label-container flex flex-col items-center justify-center w-[144px] text-center h-[144px] border-2 border-[#DEE2E6] border-solid rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                            style="background-image: url('{{ isset($buissnessData) && isset($image[1]) ? asset($image[1]) : '' }}')">
                            <img id="preview2"
                                class="absolute inset-0 w-full h-full object-cover hidden bg-gray-100 dark:bg-gray-700 rounded-lg" />
                            <div
                                class="flex flex-col items-center justify-center pt-5 text-center {{ isset($buissnessData) && isset($image[1]) ? 'hidden' : '' }}">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center"><span
                                        class="font-semibold">Upload</span> <br> <span>100*100</span></p>
                            </div>
                            <input id="dropzone-file2" type="file" class="hidden" name="bus_img2"
                                value="{{ isset($buissnessData) && isset($image[1]) ? $image[1] : '' }}"
                                accept="image/*" />
                        </label>

                        <!-- Upload and Preview Container 3 -->
                        <label for="dropzone-file3"
                            class="label-container flex flex-col items-center justify-center w-[144px] text-center h-[144px] border-2 border-[#DEE2E6] border-solid rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                            style="background-image: url('{{ isset($buissnessData) && isset($image[2]) ? asset($image[2]) : '' }}')">
                            <img id="preview3"
                                class="absolute inset-0 w-full h-full object-cover hidden bg-gray-100 dark:bg-gray-700 rounded-lg" />
                            <div
                                class="flex flex-col items-center justify-center pt-5 text-center {{ isset($buissnessData) && isset($image[2]) ? 'hidden' : '' }}">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center"><span
                                        class="font-semibold">Upload</span> <br> <span>100*100</span></p>
                            </div>
                            <input id="dropzone-file3" type="file" class="hidden" name="bus_img3"
                                value="{{ isset($buissnessData) && isset($image[2]) ? $image[2] : '' }}"
                                accept="image/*" />
                        </label>

                        <!-- Upload and Preview Container 4 -->
                        <label for="dropzone-file4"
                            class="label-container flex flex-col items-center justify-center w-[144px] text-center h-[144px] border-2 border-[#DEE2E6] border-solid rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600"
                            style="background-image: url('{{ isset($buissnessData) && isset($image[3]) ? asset($image[3]) : '' }}')">
                            <img id="preview4"
                                class="absolute inset-0 w-full h-full object-cover hidden bg-gray-100 dark:bg-gray-700 rounded-lg" />
                            <div
                                class="flex flex-col items-center justify-center pt-5 text-center {{ isset($buissnessData) && isset($image[3]) ? 'hidden' : '' }}">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center"><span
                                        class="font-semibold">Upload</span> <br> <span>1920*1080</span></p>
                                <input id="dropzone-file4" type="file" class="hidden" name="bus_img4"
                                    value="{{ isset($buissnessData) && isset($image[3]) ? $image[3] : '' }}"
                                    accept="image/*" />
                        </label>



                    </div>


                </div>
                <div class="flex mt-5 gap-14">

                    <div class="">@lang('lang.Videos')</div>

                    <div class="flex items-center w-full gap-14">
                        <!-- Upload and Preview Container -->
                        <div id="upload-container"
                            class="relative w-[331px] h-[180px] border-2 border-[#DEE2E6] border-solid rounded-lg bg-gray-50 dark:bg-gray-700 dark:border-gray-600 cursor-pointer flex items-center justify-center">
                            <!-- Video Preview -->
                            <video id="video-preview" controls
                                class="absolute inset-0 w-full h-full hidden bg-gray-100 dark:bg-gray-700 rounded-lg">
                                Your browser does not support the video tag.
                            </video>

                            <!-- Upload Area -->
                            <div class="flex flex-col items-center justify-center w-full h-full">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">@lang('lang.Upload_Video')</span></p>
                            </div>
                            <input id="dropzone-file5" type="file" name="video" class="hidden"
                                accept="video/*" value="{{ !isset($buissnessData) ? '' : $buissnessData->video }}" />
                        </div>
                    </div>



                </div>
                <div class="w-full  gap-x-4 gap-y-2 mt-5 grid grid-cols-2">
                    <div>
                        <label class="block mb-2" for="bus_category">@lang('lang.Category')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px]
                             focus:border-primary  h-[40px] text-[14px]"
                            name="category" id="bus_category">
                            <option selected disabled> @lang('lang.Select_Category')</option>
                            @foreach ($categories as $category)
                                @if (isset($buissnessData))
                                    <option {{ !isset($buissnessData) == $buissnessData->category ? '' : 'selected' }}
                                        value=" {{ $category->category_name }}"> {{ $category->category_name }}
                                    </option>
                                @else
                                    <option value="{{ $category->category_name }}"> {{ $category->category_name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2" for="bus_title">@lang('lang.Title')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                            name="title" id="bus_title" placeholder=" @lang('lang.Title')"
                            value="{{ !isset($buissnessData) ? '' : $buissnessData->title }}">
                    </div>

                    <div>
                        <label class="block mb-2" for="bus_country">@lang('lang.Country')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px]
                            focus:border-primary   h-[40px] text-[14px]"
                            name="country" id="bus_country">
                            <option selected disabled> @lang('lang.Select_Country')</option>
                            @if (isset($buissnessData))
                                <option selected value="{{ $buissnessData->country }}">{{ $buissnessData->country }}
                                </option>
                            @endif
                            @include('includes.countrieslist')
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2" for="bus_city">@lang('lang.City')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                            name="city" id="bus_city" placeholder=" @lang('lang.City')"
                            value="{{ !isset($buissnessData) ? '' : $buissnessData->city }}">
                    </div>
                    <div class=" col-span-2  ">
                        <label class="block mb-2" for="bus_description">@lang('lang.Description')</label>
                        <textarea name="description" id="bus_description"
                            class="w-full h-28  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Description')">{{ !isset($buissnessData) ? '' : $buissnessData->description }}</textarea>
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-2" for="bus_price">@lang('lang.Price')</label>
                        <input type="text" required
                            class="w-[50%] border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                            name="price" id="bus_price" placeholder=" @lang('lang.Price')"
                            value="{{ !isset($buissnessData) ? '' : $buissnessData->price }}">
                    </div>
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
                        @lang(!isset($buissnessData) ? 'lang.Save' : 'lang.Update')
                    </div>

                </button>
            </div>
        </div>
        </form>
        <div>

        </div>

    </div>
</div>


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







{{-- Delete Data Modal --}}
<div id="deleteData" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="flex justify-center items-center h-full">
        <div class="fixed inset-0 transition-opacity">
            <div id="backdrop" class="absolute inset-0 bg-slate-800 opacity-75"></div>
        </div>
        <div class="relative p-4 w-full   max-w-lg max-h-full ">
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="">

                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="deleteData">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div class=" mx-6 my-6 pt-5">
                    <div class="">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100px" class="mx-auto"
                            viewBox="0 0 512 512">
                            <path
                                d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"
                                fill="red" />
                        </svg>
                        <h1 class="text-center pt-3 text-4xl">@lang('lang.Are_You_Sure')</h1>
                        <div class="flex  justify-center gap-5 mx-auto mt-5 pb-5">
                            <button data-modal-hide="deleteData" class="bg-primary px-7 py-3 text-white rounded-md">
                                @lang('lang.No')
                            </button>
                            <a class="" id="delLink" href="">

                                <button class=" bg-red-600 px-7 py-3 text-white rounded-md">
                                    @lang('lang.Yes')
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('layouts.footer')
@if (isset($buissnessData))
    <script>
        $(document).ready(function() {
            $('#addcustomermodal').removeClass("hidden");
            $('#addcustomermodal').addClass("flex");
        });
    </script>
@endif
<script>
    // Function to handle file input and preview image
    function setupFileInput(inputId, previewId) {
        const fileInput = document.getElementById(inputId);
        const previewImage = document.getElementById(previewId);

        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const objectURL = URL.createObjectURL(file);
                previewImage.src = objectURL;
                previewImage.style.display = 'block'; // Show the image element

                // Clean up the object URL after image is loaded
                previewImage.addEventListener('load', () => {
                    URL.revokeObjectURL(objectURL);
                }, {
                    once: true
                });
            }
        });
    }

    // Setup each file input and preview
    setupFileInput('dropzone-file1', 'preview1');
    setupFileInput('dropzone-file2', 'preview2');
    setupFileInput('dropzone-file3', 'preview3');
    setupFileInput('dropzone-file4', 'preview4');

    document.getElementById('upload-container').addEventListener('click', function() {
        document.getElementById('dropzone-file5').click();
    });

    document.getElementById('dropzone-file5').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const videoPreview = document.getElementById('video-preview');
            const objectURL = URL.createObjectURL(file);
            videoPreview.src = objectURL;
            videoPreview.style.display = 'block'; // Show the video element

            // Clean up the object URL after video preview is finished
            videoPreview.addEventListener('loadeddata', () => {
                URL.revokeObjectURL(objectURL);
            }, {
                once: true
            });
        }
    });
    $(document).ready(function() {
        $('.view-button').on('click', function() {
            var businessId = $(this).data('id');

            $.ajax({
                url: '/bussinesses/' + businessId,
                method: 'GET',
                success: function(data) {
                    // Populate the modal fields
                    $('#videoTag').attr('src', data.video);
                    $('#updatecustomermodal h1').text(data.title);
                    $('#updatecustomermodal .category').text(data.category);
                    $('#updatecustomermodal .location').text(data.city + ' ' + data
                        .country);
                    $('#updatecustomermodal .description').text(data.description);
                    $('#updatecustomermodal .date').text(data.date);

                    var imagesContainer = $(
                        '#updatecustomermodal .video-container .images');
                    var firstImageContainer = $('#updatecustomermodal .first-image');

                    imagesContainer.empty();
                    firstImageContainer.empty();

                    try {
                        var images = JSON.parse(data
                            .images); // Assuming 'images' is the field name

                        if (images.length > 0) {
                            // Display the first image
                            var firstImage = images[0];
                            firstImageContainer.append('<img src="' + asset(firstImage) +
                                '" alt="First Image" class="h-[350px] w-[500px] object-contain">'
                            );

                            // Display the last three images, excluding the first one
                            var lastThreeImages = images.slice(-3); // Get the last 3 images
                            lastThreeImages.forEach(function(image) {
                                if (image !==
                                    firstImage) { // Exclude the first image
                                    imagesContainer.append('<img src="' + asset(
                                            image) +
                                        '" alt="Business Image" width="116px">');
                                }
                            });
                        }

                    } catch (e) {
                        console.error("Error parsing images:", e);
                    }

                    // Show the modal
                    $('#updatecustomermodal').removeClass('hidden');
                },
                error: function() {
                    alert('Error fetching data.');
                }
            });
        });

        // Hide modal on close button click
        $('[data-modal-hide="updatecustomermodal"]').on('click', function() {
            $('#updatecustomermodal').addClass('hidden');
        });
    });

    function asset(path) {
        return '{{ asset('') }}' + path; // Use Laravel's asset helper
    }

    $(document).ready(function() {
        $("#buissnessForm").submit(function(event) {
            let url = $('#buissnessForm').attr('url');
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
                    window.location.href = '../businesses';

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

        function deleteDatafun() {

            $('.delButton').click(function() {
                $('#deleteData').removeClass("hidden");
                var id = $(this).attr('delId');
                $('#delLink').attr('href', '../bussinessesDel/' + id);
            });

        }
        deleteDatafun();
        $('#datatable').on('draw.dt', function() {
            deleteDatafun();
        });
    });
</script>
