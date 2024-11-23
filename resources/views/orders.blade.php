@extends('layouts.layout')

@section('title')
    Business
@endsection

@section('content')
<button data-modal-target="change-status-modal" data-modal-toggle="change-status-modal"></button>
<div class="md:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Orders')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Orders_List')</h3>
                <div>


                </div>
            </div>
            <div class="overflow-x-auto">
                <table  id="datatable" class="dataTable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">Business Title</th>
                            <th class="whitespace-nowrap">@lang('lang.Order_No') #</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">Contact</th>
                            <th class="whitespace-nowrap">@lang('lang.Price')</th>
                            <th class="whitespace-nowrap">Location</th>
                            <th class="whitespace-nowrap">@lang('lang.Date')</th>
                            <th class="whitespace-nowrap">@lang('lang.Status')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody class="border-b border-gray-500" id="tableBody">
                        @foreach ($orders as $i => $order)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>Test-1</td>
                                {{-- <td>{{  $order->business->title }}</td> --}}
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->buyer_name }}</td>
                                <td><a href="tel:{{ $order->buyer_contact }}" class="text-blue-600">{{ $order->buyer_contact }}</a></td>
                                <td>{{ $order->desired_location }}</td>
                                <td>{{ $order->budget }}&euro;</td>
                                <td>{{ $order->created_at->format('M-d-y') }}</td>
                                <td><button updateId={{$order->id}}  class="updateStatus">
                                    <span class="{{  $order->status == 'cancel' ? 'text-green-800' : ($order->status == 'sold' ? 'text-purple-800' : 'text-red-700') }} font-semibold text-sm">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                    </button></td>
                                <td>
                                    <div class="flex gap-5 ">
                                        <button data-modal-target="business-detail-modal"
                                        url="../getSingleorders/{{ $order->id }}"
                                            data-modal-toggle="business-detail-modal" data-id="{{ $order->id }}"
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

    {{-- change status modal --}}
    <x-modal id="change-status-modal">
        <x-slot name="title">@lang('lang.Details')</x-slot>
        <x-slot name="modal_width">max-w-2xl</x-slot>
        <x-slot name="body">
            <form id="postDataForm"  url="changeOrderStatus" method="post">
                @csrf
                <input type="hidden" id="updateStatusId" name="update_id">
                <div>
                    <x-select id="status" label="{{ __('lang.Status') }}" name='status'>
                        <x-slot name="options">
                            <option selected disabled> @lang('lang.Select_Status')</option>
                            <option value="pending" >Pending</option>
                            <option value="sold" >Sold</option>
                            <option value="cancel">Cancel</option>

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
                          
                        </div>
                    </div>
                </div>
                <div class="px-5 py-7 w-full lg:w-[50%]">
                    <h1 class="text-4xl font-bold">@lang('lang.Details')</h1>
                    <div class="h-1 bg-black w-40 mt-3"></div>
                    <div class="flex gap-20 pt-7">
                        <h5 class="font-bold text-nowrap">
                            Business @lang('lang.Title') :</h5>
                        <p class="text-justify break-words" id="dTitle"></p>
                    </div>
                    <div class="flex gap-10 pt-3">
                        <h5 class="font-bold">Buyer Name :</h5>
                        <p  id="dName"></p>
                    </div>
                    <div class="flex gap-10 pt-3">
                        <h5 class="font-bold">Buyer Contact :</h5>
                        <p  id="dContact" class="text-blue-500"></p>
                    </div>
                    <div class="flex gap-10 pt-3">
                        <h5 class="font-bold">Budget :</h5>
                        <p class="category" id="dprice"></p>
                    </div>
                    <div class="flex gap-12 pt-3">
                        <h5 class="font-bold">@lang('lang.Location') :</h5>
                        <p class="location" id="dLocation"></p>
                    </div>
                    <div class="flex gap-20 pt-3">
                        <h5 class="font-bold">Order @lang('lang.Date') :</h5>
                        <p class="date" id='Date'></p>
                    </div>
                    <div class="flex gap-6 pt-3">
                        <h5 class="font-bold text-nowrap">
                          Business  @lang('lang.Description') :</h5>
                        <p class="text-justify description break-words" id="dDescription"></p>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-modal>
    @endsection
@section('js')
    <script>
        function updateDatafun(){


        }
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
                        $('#dName').text('');
                        $('#dLocation').text('');
                        $('#dprice').text('');
                        $('#dContact').text('');
                        $('#Date').text('');
                        $('#dDescription').text('');
                        $('#dTitle').text('');
                        $('#videoTag').attr('src', '');
                        $('#dimage-1').attr('src', './images/compnay-logo.svg');
                        const $imageContainer = $('#image-container');
                        $imageContainer.empty();
                        if (response.success) {
                            let data = response.data;
                            $('#dName').text(data.buyer_name)
                            $('#dLocation').text(data.desired_location)
                            $('#Date').text(data.date)
                            $('#dDescription').text(data.business.description)
                            $('#dTitle').text(data.business.title)
                            $('#dprice').text(data.budget + "Є")
                            $('#dContact').text(data.buyer_contact)

                         
                            $('#dimage-1').attr('src', data.business.images[0])
                            const $imageContainer = $('#image-container');

                            $('#dimage-1').attr('src', data.business.images[0]);
                            data.business.images.forEach((src, index) => {
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
             // Listen for the custom form submission response event
        $(document).on("formSubmissionResponse", function(event, response, Alert, SuccessAlert, WarningAlert) {
            if (response.success) {
                getData()
                $('.modalCloseBtn').click();
            } else {}
        });
    </script>
@endsection
