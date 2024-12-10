@extends('layouts.layout')
@section('title')
    Review & Experience
@endsection
@section('content')
    <div class="md:mx-4 mt-12">
        <div>
            <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Reviews_&_Experience')</h1>
        </div>
        <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
            <div>
                <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                    <div class="flex gap-5 items-center">
                        <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Review_&_Experience')</h3>
                        <div class="flex gap-4 items-center">
                            <div class="flex items-center ">
                                <input id="review" type="radio" value="" name="default-radio"
                                    {{ @$_GET['type'] === 'review' ? 'checked' : '' }}
                                    class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="sending"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Review</label>
                            </div>
                            <div class="flex items-center ">
                                <input id="experience" type="radio" value="" name="default-radio"
                                    {{ @$_GET['type'] == 'review' ? '' : 'checked' }}
                                    class="w-4 h-4 text-primary bg-gray-100 border-gray-300 focus:ring-primary dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="request"
                                    class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Experience</label>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-5">
                        @if (@$_GET['type'] == 'review')
                            <div>

                                <button id="addModalBtn" url="../insertReview" data-modal-target="reviewModal" data-modal-toggle="reviewModal"
                                    class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                                    @lang('lang.Review')</button>
                            </div>
                        @endif
                        @if (@$_GET['type'] !== 'review')
                            <div>

                                <button id="addModalBtn" url="../insertExperience" data-modal-target="experienceModal" data-modal-toggle="experienceModal"
                                    class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                                    @lang('lang.Experience')</button>
                            </div>
                        @endif

                    </div>
                </div>
                <div class="overflow-x-auto">
                    @if (@$_GET['type'] == 'review')
                        <table id="datatable">
                            <thead class="py-6 bg-primary text-white">
                                <tr>
                                    <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Profile_Picture')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Name')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Role')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Location')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Rating')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Description')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Status')</th>
                                    <th class="flex  justify-center">@lang('lang.Action')</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img class="h-24 w-24 rounded-full bg-black object-contain"
                                                src="{{ asset($review->image) }}" alt="profile"></td>
                                        <td>{{ $review->name }}</td>
                                        <td>{{ $review->role }}</td>
                                        <td>{{ $review->location }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ \Str::limit($review->description, 60) }}
                                        </td>
                                        <td class="whitespace-nowrap"> <span
                                                class="font-semibold {{ $review->status == 'active' ? 'text-green-500' : 'text-red-800' }}">
                                                {{ $review->status }} </span></td>
                                        <td>
                                            <div class="flex gap-5 items-center justify-center">
                                                <button class="updateReviewBtn" url="../updateReview/{{ $review->id }}"
                                                    Status="{{$review->status}}" Name="{{ $review->name }}"  Role="{{ $review->role }}"  Location="{{ $review->location }}" Rating="{{ $review->rating }}" Description="{{ $review->description }}">
                                                    <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                                        xmlns='http://www.w3.org/2000/svg'>
                                                        <circle opacity='0.1' cx='18' cy='18' r='18'
                                                            fill='#233A85' />
                                                        <path fill-rule='evenodd' clip-rule='evenodd'
                                                            d='M16.1637 23.6188L22.3141 15.665C22.6484 15.2361 22.7673 14.7402 22.6558 14.2353C22.5593 13.7763 22.277 13.3399 21.8536 13.0088L20.8211 12.1886C19.9223 11.4737 18.8081 11.549 18.1693 12.3692L17.4784 13.2654C17.3893 13.3775 17.4116 13.543 17.523 13.6333C17.523 13.6333 19.2686 15.0329 19.3058 15.063C19.4246 15.1759 19.5137 15.3264 19.536 15.507C19.5732 15.8607 19.328 16.1918 18.9641 16.2369C18.7932 16.2595 18.6298 16.2068 18.511 16.109L16.6762 14.6492C16.5871 14.5822 16.4534 14.5965 16.3791 14.6868L12.0188 20.3304C11.7365 20.6841 11.64 21.1431 11.7365 21.5871L12.2936 24.0025C12.3233 24.1304 12.4348 24.2207 12.5685 24.2207L15.0197 24.1906C15.4654 24.1831 15.8814 23.9799 16.1637 23.6188ZM19.5958 22.8672H23.5929C23.9829 22.8672 24.3 23.1885 24.3 23.5835C24.3 23.9794 23.9829 24.2999 23.5929 24.2999H19.5958C19.2059 24.2999 18.8887 23.9794 18.8887 23.5835C18.8887 23.1885 19.2059 22.8672 19.5958 22.8672Z'
                                                            fill='#233A85' />
                                                    </svg>
                                                </button>
                                                        <button class="deleteDataBtn"
                                                        delUrl="deleteReview/{{ $review->id }}">
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


                            </tbody>
                        </table>
                    @else
                        <table id="datatable">
                            <thead class="py-6 bg-primary text-white">
                                <tr>
                                    <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Profile_Picture')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Name')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Role')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Location')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Subject')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Category')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Description')</th>
                                    <th class="whitespace-nowrap">@lang('lang.Status')</th>
                                    <th class="flex  justify-center">@lang('lang.Action')</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                @foreach ($experiences as $experience)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img class="h-24 w-24 rounded-full bg-black object-contain"
                                                src="{{ asset($experience->image) }}" alt="profile"></td>
                                        <td>{{ $experience->name }}</td>
                                        <td>{{ $experience->role }}</td>
                                        <td>{{ $experience->location }}</td>
                                        <td>{{ $experience->subject }}</td>
                                        <td>{{ $experience->category }}</td>
                                        <td>{{ $experience->description }}</td>
                                        <td> <span
                                                class="font-semibold {{ $experience->status == 'active' ? 'text-green-500' : 'text-red-800' }}">
                                                {{ $experience->status }} </span></td>
                                        <td>
                                            <div class="flex gap-5 items-center justify-center">
                                                <button class="updateExpBtn" url="../updateExperience/{{ $experience->id }}"
                                                    Status="{{$experience->status}}" Name="{{ $experience->name }}"  Role="{{ $experience->role }}"  Location="{{ $experience->location }}" Subject="{{ $experience->subject }}" Category="{{$experience->category}}" Description="{{ $experience->description }}">
                                                    <svg width='36' height='36' viewBox='0 0 36 36' fill='none'
                                                        xmlns='http://www.w3.org/2000/svg'>
                                                        <circle opacity='0.1' cx='18' cy='18' r='18'
                                                            fill='#233A85' />
                                                        <path fill-rule='evenodd' clip-rule='evenodd'
                                                            d='M16.1637 23.6188L22.3141 15.665C22.6484 15.2361 22.7673 14.7402 22.6558 14.2353C22.5593 13.7763 22.277 13.3399 21.8536 13.0088L20.8211 12.1886C19.9223 11.4737 18.8081 11.549 18.1693 12.3692L17.4784 13.2654C17.3893 13.3775 17.4116 13.543 17.523 13.6333C17.523 13.6333 19.2686 15.0329 19.3058 15.063C19.4246 15.1759 19.5137 15.3264 19.536 15.507C19.5732 15.8607 19.328 16.1918 18.9641 16.2369C18.7932 16.2595 18.6298 16.2068 18.511 16.109L16.6762 14.6492C16.5871 14.5822 16.4534 14.5965 16.3791 14.6868L12.0188 20.3304C11.7365 20.6841 11.64 21.1431 11.7365 21.5871L12.2936 24.0025C12.3233 24.1304 12.4348 24.2207 12.5685 24.2207L15.0197 24.1906C15.4654 24.1831 15.8814 23.9799 16.1637 23.6188ZM19.5958 22.8672H23.5929C23.9829 22.8672 24.3 23.1885 24.3 23.5835C24.3 23.9794 23.9829 24.2999 23.5929 24.2999H19.5958C19.2059 24.2999 18.8887 23.9794 18.8887 23.5835C18.8887 23.1885 19.2059 22.8672 19.5958 22.8672Z'
                                                            fill='#233A85' />
                                                    </svg>
                                                </button>
                                                <button class="deleteDataBtn"
                                                    delUrl="deleteExperience/{{ $experience->id }}">
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


                            </tbody>
                        </table>
                    @endif
                </div>

            </div>
        </div>
    </div>


    {{-- Add Offer Modal --}}
    @if (@$_GET['type'] == 'review')
        <div id="reviewModal" data-modal-backdrop="static"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
            <div class="relative p-4 w-full  rounded-3xl  max-w-2xl max-h-full ">
                <form id="postDataForm" url="../insertReview" method="post">
                    @csrf
                    <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                        <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                            <h3 class="text-xl font-semibold text-white ">
                                @lang('lang.Review')
                            </h3>
                            <button type="button"
                                class="modalCloseBtn absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                                data-modal-hide="reviewModal">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>


                        <div class="p-5 px-10">

                            <div class="w-full   lg:mt-0 mt-5">
                            <label for="blog_category">@lang('lang.Status')</label>
                                <select
                                    class="w-full border-[#DEE2E6] rounded-[4px]
                             focus:border-primary   h-[40px] text-[14px]"
                                    name="status" id="Status">
                                    <option selected disabled> @lang('lang.Select_Status')</option>
                                    <option value="active"> @lang('lang.Active')</option>
                                    <option value="de-active"> @lang('lang.De_Active')</option>
                                </select>
                            </div>
                            <div class="  mt-2 ">
                                <label for="Name">@lang('lang.Name')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="name" id="Name" placeholder=" @lang('lang.Name')">
                            </div>
                            <div class="  mt-2 ">
                                <label for="Role">@lang('lang.Role')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="role" id="Role" placeholder=" @lang('lang.Role')">
                            </div>
                            <div class="  mt-2 ">
                                <label for="ProfilePicture">@lang('lang.Profile_Picture')</label>
                                <input type="file" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="image" id="ProfilePicture">
                            </div>
                            {{-- <div class="flex mt-5 gap-12">

                        <div><img src="{{ asset('./images/Headshot.svg') }}" alt="" class="rounded-full"></div>
                        <div class="flex flex-col ps-1 justify-center">
                            <h1 class="font-bold">M-Arham Waheed</h1>
                            <p>Project Marketing Services Specialist</p>
                        </div>

                    </div> --}}

                            <div class=" mt-2 ">
                                <div><label for="Rating">@lang('lang.Rating')</label></div>
                                <select name="rating" id="Rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>

                            <div class="  mt-2 ">
                                <label for="location">@lang('lang.Location')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="location" id="Location" placeholder=" @lang('lang.Location')">
                            </div>

                            <div class="  mt-2 ">
                                <label class="" for="review_description">@lang('lang.Description')</label>
                                <textarea name="description" id="review_description"
                                    class="w-full h-28  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                                    placeholder="@lang('lang.Description')"></textarea>
                            </div>

                            <div class="flex justify-end my-2 ">
                                <x-modal-button title="Add"></x-modal-button>
                            </div>
                        </div>
                    </div>
                </form>
                <div>

                </div>

            </div>
        </div>
    @endif

    {{-- ============ update  customer modal  =========== --}}
    @if (@$_GET['type'] !== 'review')
        <div id="experienceModal" data-modal-backdrop="static"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
            <div class="relative p-4 w-full   max-w-2xl max-h-full ">
                <form id="postDataForm" url="../insertExperience" method="post">
                    {{-- <form method="post" action="../insertExperience" enctype="multipart/form-data"> --}}
                    @csrf
                    <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                        <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                            <h3 class="text-xl font-semibold text-white " id="modalTitle">
                                @lang('lang.Experience')
                            </h3>
                            <button type="button"
                                class="modalCloseBtn absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                                data-modal-hide="experienceModal">
                                <svg class="w-4 h-4 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>




                        <div class="p-5 px-10">

                            <div class="w-full   lg:mt-0 mt-5">
                                <label for="expStatus">@lang('lang.Status')</label>
                                <select
                                    class="w-full border-[#DEE2E6] rounded-[4px]
                             focus:border-primary   h-[40px] text-[14px]"
                                    name="status" id="expStatus">
                                    <option selected disabled> @lang('lang.Select_Status')</option>
                                    <option value="active"> @lang('lang.Active')</option>
                                    <option value="de-active"> @lang('lang.De_Active')</option>
                                </select>
                            </div>
                            <div class="  mt-2 ">
                                <label for="Name">@lang('lang.Name')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="name" id="Name" placeholder=" @lang('lang.Name')">
                            </div>
                            <div class="  mt-2 ">
                                <label for="Role">@lang('lang.Role')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="role" id="Role" placeholder=" @lang('lang.Role')">
                            </div>
                            <div class="  mt-2 ">
                                <label for="location">@lang('lang.Location')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="location" id="Location" placeholder=" @lang('lang.Location')">
                            </div>

                            <div class="  mt-2 ">
                                <label for="ProfilePicture">@lang('lang.Profile_Picture')</label>
                                <input type="file" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="image" id="ProfilePicture">
                            </div>
                            <div class=" mt-2">
                                <label for="exp_subject">@lang('lang.Subject')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="subject" class="ps-1" id="exp_subject" placeholder=" @lang('lang.Enter_Subject')">
                            </div>

                            <div class=" mt-2">
                                <label for="exp_category"">@lang('lang.Category')</label>
                                <input type="text" required
                                    class="w-full border-[#DEE2E6] rounded-[4px] focus:border-primary
                              h-[40px] text-[14px]"
                                    name="category" id="exp_category" class="ps-1" placeholder=" @lang('lang.Business_Category')">
                            </div>

                            <div class="mt-2 ">
                                <label class="" for="exp_description">@lang('lang.Description')</label>
                                <textarea name="description" id="exp_description"
                                    class="w-full h-28  border-[#DEE2E6] rounded-[4px] focus:border-primary text-[14px] "
                                    placeholder="@lang('lang.Enter_Your_Experience')"></textarea>
                            </div>

                            <div class="flex justify-end ">
                                <x-modal-button title="Add"></x-modal-button>
                            </div>
                        </div>
                </form>
                <div>

                </div>

            </div>
        </div>
    @endif


@endsection

@section('js')
    <script>
        $(document).ready(function() {

            $('#review').change(function() {
                if ($(this).is(':checked')) {
                    // Redirect to the desired page
                    window.location.href = '../reviewsAndExperience?type=review';
                }
            });
            $('#experience').change(function() {
                if ($(this).is(':checked')) {
                    // Redirect to the desired page
                    window.location.href = '../reviewsAndExperience';
                }
            });
        });

        function updateDatafun() {
            $(".updateReviewBtn").click(function() {
                $('#reviewModal').addClass('flex').removeClass('hidden');
                $('#Name').val($(this).attr('Name'));
                $('#Role').val($(this).attr('Role'));
                $('#Rating').val($(this).attr('Rating')).trigger('change');
                $('#Location').val($(this).attr('Location'));
                $('#review_description').val($(this).attr('Description'));
                $('#Status').val($(this).attr('Status')).trigger('change');
                $('#postDataForm').attr('url', $(this).attr('url'));

                $('#ProfilePicture').removeAttr('required');

                $('#reviewModal #btnText').text("Update");
            });
            $(".updateExpBtn").click(function() {
                $('#experienceModal').addClass('flex').removeClass('hidden');
                $('#Name').val($(this).attr('Name'));
                $('#Role').val($(this).attr('Role'));
                $('#exp_subject').val($(this).attr('subject'));
                $('#Location').val($(this).attr('Location'));
                $('#exp_category').val($(this).attr('category'));
                $('#exp_description').val($(this).attr('Description'));
                $('#expStatus').val($(this).attr('Status')).trigger('change');
                $('#postDataForm').attr('url', $(this).attr('url'));
                $('#ProfilePicture').removeAttr('required');
                $('#reviewModal #btnText').text("Update");
            });

        }
        updateDatafun()

        $('#addModalBtn').click(function() {
            $('#postDataForm')[0].reset();
            $('#postDataForm').attr('url' , $(this).attr('url'));
            $('#ProfilePicture').attr('required', true);

            $('#Rating').trigger('change');
            $('#Status').trigger('change');

            $('#reviewModal #btnText').text("Add");
            let fileImg = $('#blog-modal .file-preview');
            fileImg.addClass('hidden');

        });
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            if (response.success) {
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
