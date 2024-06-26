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
        <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Reviews_&_Experience')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Review_&_Experience')</h3>
                <div class="flex gap-5">

                    <div>

                        <button data-modal-target="addcustomermodal" data-modal-toggle="addcustomermodal"
                            class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                            @lang('lang.Review')</button>
                    </div>
                    <div>

                        <button data-modal-target="updatecustomermodal" data-modal-toggle="updatecustomermbodal"
                            class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                            @lang('lang.Experience')</button>
                    </div>

                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Type')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Address')</th>
                            <th class="whitespace-nowrap">@lang('lang.Date')</th>
                            <th class="whitespace-nowrap">@lang('lang.Status')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>

                        <td>01</td>
                        <td>M-Arham Waheed</td>
                        <td>123-456-789</td>
                        <td>Town , City</td>
                        <td>Town , City</td>
                        <td>Town , City</td>
                        <td>
                            <div class="flex gap-5 items-center justify-center">
                                <a href=""><img width="38px" src="{{ asset('images/icons/edits.svg') }}"
                                        alt="update"></a>
                                <a href=""> <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                        alt="Delete"></a>
                                <button data-modal-target="updatecustomermodal" data-modal-toggle="updatecustomermodal"
                                    class="cursor-pointer ">
                                    <img width="38px" src="{{ asset('images/icons/views.svg') }}"
                                        alt="View"></button>

                            </div>
                        </td>
                        {{-- @foreach ($customers as $x => $data)
                            <tr class="pt-4">
                                <td>{{ $x + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->role }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <button data-modal-target="updatecustomermodal"
                                            data-modal-toggle="updatecustomermodal"
                                            class=" updateBtn cursor-pointer  w-[42px] md:w-full"
                                            updateId="{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edit.svg') }}" alt="update"></button>
                                        <a class="w-[42px] md:w-full" href="../delCustomer/{{ $data->id }}"><img
                                                width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                                alt="update"></button></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach --}}

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


{{-- Add Offer Modal --}}

<div id="addcustomermodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full  rounded-3xl  max-w-2xl max-h-full ">
        <form id="customerData" method="post" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Review')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="addcustomermodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>


                <div class="p-5 px-10">

                    <div class="w-full flex items-center gap-16  lg:mt-0 mt-5">
                        <label for="blog_category">@lang('lang.Status')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px]
                             focus:border-primary   h-[40px] text-[14px]"
                            name=blog_category" id="blog_category">
                            <option value="" class="text-wrap"> @lang('lang.Select_Status')</option>
                            <option value="today"> @lang('lang.Today')</option>
                            <option value="last_week"> @lang('lang.This_Week')</option>
                            <option value="last_month"> @lang('lang.This_Month')</option>
                        </select>
                    </div>

                    <div class="flex mt-5 gap-12">

                        <div><img src="{{ asset('./images/Headshot.svg') }}" alt="" class="rounded-full"></div>
                        <div class="flex flex-col ps-1 justify-center">
                            <h1 class="font-bold">M-Arham Waheed</h1>
                            <p>Project Marketing Services Specialist</p>
                        </div>

                    </div>

                    <div class="flex mt-5 gap-12">
                        <div><label for="blog_category">@lang('lang.Rating')</label></div>
                        <div class="flex gap-3 ps-2.5">
                            <img src="{{ asset('./images/yellow-star.svg') }}" alt="">
                            <img src="{{ asset('./images/yellow-star.svg') }}" alt="">
                            <img src="{{ asset('./images/yellow-star.svg') }}" alt="">
                            <img src="{{ asset('./images/star.svg') }}" alt="">
                            <img src="{{ asset('./images/star.svg') }}" alt="">
                        </div>
                    </div>

                    <div class=" flex gap-11 mt-5 items-center">
                        <label for="review_demo">@lang('lang.Location')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                            name="review_demo" id="review_demo" placeholder=" @lang('lang.Location')">
                    </div>

                    <div class=" flex gap-5 mt-5 ">
                        <label class="" for="review_description">@lang('lang.Description')</label>
                        <textarea name="review_description" id="review_description"
                            class="w-full h-28  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Description')"></textarea>
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
                            @lang('lang.Save')
                        </div>

                    </button>
                </div>
            </div>
        </form>
        <div>

        </div>

    </div>
</div>


{{-- ============ update  customer modal  =========== --}}
<div id="updatecustomermodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full   max-w-2xl max-h-full ">
        <form id="UpdatecustomerData" method="post" action="../addExperience" enctype="multipart/form-data">
            @csrf

            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Experience')
                    </h3>
                    <button type="button"
                        class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                        data-modal-hide="updatecustomermodal">
                        <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>




                <div class="p-5 px-10">

                    <div class="w-full flex items-center gap-16  lg:mt-0 mt-5">
                        <label for="blog_category">@lang('lang.Status')</label>
                        <select
                            class="w-full border-[#DEE2E6] rounded-[4px]
                             focus:border-primary   h-[40px] text-[14px]"
                            name=blog_category" id="blog_category">
                            <option value="" class="text-wrap"> @lang('lang.Select_Status')</option>
                            <option value="today"> @lang('lang.Today')</option>
                            <option value="last_week"> @lang('lang.This_Week')</option>
                            <option value="last_month"> @lang('lang.This_Month')</option>
                        </select>
                    </div>

                    <div class="flex mt-5 gap-12">

                        <div><img src="{{ asset('./images/Headshot.svg') }}" alt="" class="rounded-full">
                        </div>
                        <div class="flex flex-col ps-1 justify-center">
                            <h1 class="font-bold">M-Arham Waheed</h1>
                            <p>Project Marketing Services Specialist</p>
                        </div>

                    </div>

                    <div class="flex items-center  w-full gap-14 mt-5">

                        <label for="exp_subject" class="ps-1">@lang('lang.Image')</label>


                        <label for="dropzone-file1"
                            class="label-container flex flex-col items-center justify-center w-[144px] text-center h-[144px] border-2 border-[#DEE2E6] border-solid rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 text-center">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                </svg>
                                <p class="text-sm text-gray-500 dark:text-gray-400"><span
                                        class="font-semibold">@lang('lang.Upload_Image')</span></p>
                            </div>
                            <input id="dropzone-file1" type="file" class="hidden" name="bus_img1" />
                        </label>



                    </div>

                    <div class=" flex gap-12 mt-5 items-center">
                        <label for="exp_subject">@lang('lang.Subject')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                            name="exp_subject" class="ps-1" id="exp_subject" placeholder=" @lang('lang.Enter_Subject')">
                    </div>

                    <div class=" flex gap-8 mt-5 items-center">
                        <label for="exp_category"">@lang('lang.Category')</label>
                        <input type="text" required
                            class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                            name="exp_category" id="exp_category" class="ps-1" placeholder=" @lang('lang.Business_Category')">
                    </div>

                    <div class=" flex gap-5 mt-5 ">
                        <label class="" for="exp_description">@lang('lang.Description')</label>
                        <textarea name="exp_description" id="exp_description"
                            class="w-full h-28  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                            placeholder="@lang('lang.Enter_Your_Experience')"></textarea>
                    </div>

                </div>
            </div>
        </form>
        <div>

        </div>

    </div>
</div>

@include('layouts.footer')


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
</script>
