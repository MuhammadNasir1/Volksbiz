@include('layouts.header')
@include('layouts.nav')



<div class="md:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.Subscription_Plans')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Subscription_Plans')</h3>

                <div>

                    <button data-modal-target="addcustomermodal" data-modal-toggle="addcustomermodal"
                        class="bg-primary cursor-pointer text-white h-12 px-5 rounded-[6px]  shadow-sm font-semibold ">+
                        @lang('lang.Add_Plan')</button>
                </div>

            </div>

            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Price')</th>
                            <th class="whitespace-nowrap">@lang('lang.Options')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscriptionData as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->price }}</td>
                                @php
                                    $options = json_decode($data->option, true);
                                @endphp
                                <td>{{ implode(', ', $options) }}</td>
                                <td>
                                    <div class="flex gap-5 items-center justify-center">

                                        <a href="../editSubscription/{{ $data->id }}"><img width="38px"
                                                src="{{ asset('images/icons/edits.svg') }}" alt="update"></a>

                                        <button data-modal-target="deleteData" data-modal-toggle="deleteData"
                                            class="hidden"></button>
                                        <button class="delButton" delId="{{ $data->id }}">
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
    <div class="relative p-4 w-full  rounded-3xl  max-w-3xl max-h-full ">
        @if (isset($editData))
            <form id="subscriptionData" method="post" enctype="multipart/form-data"
                url="../UpdateSubscription/{{ $editData->id }}">
            @else
                <form action="../addSubscription" method="post" enctype="multipart/form-data">
        @endif
        @csrf
        <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
            <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                <h3 class="text-xl font-semibold text-white ">
                    @lang(!isset($editData) ? 'lang.Add_Plan' : 'lang.Update_Plan')
                </h3>
                <button type="button"
                    class=" absolute right-2 text-white bg-transparent rounded-lg text-sm w-8 h-8 ms-auto "
                    data-modal-hide="addcustomermodal">
                    @if (isset($editData))
                        @php
                            $options = json_decode($editData->option);
                        @endphp
                        <a href="../subscriptionPlan">
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
                <div class="">
                    <div class="flex w-full lg:flex-row flex-col gap-5">
                        <div class="w-full mt-4">
                            <label class="text-[16px] font-semibold block  text-[#452C88]"
                                for="plan_name">@lang('lang.Plan_Name')</label>
                            <input type="text"
                                class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                name="name" id="plan_name" placeholder="@lang('lang.Enter_Plan_Name')"
                                value="{{ !isset($editData) ? '' : $editData->name }}">
                        </div>
                        <div class="w-full lg:mt-4">
                            <label class="text-[16px] font-semibold block  text-[#452C88]"
                                for="plan_price">@lang('lang.Plan_Price')</label>
                            <input type="text"
                                class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                name="price" id="plan_price" placeholder="@lang('lang.Plan_Price')"
                                value="{{ !isset($editData) ? '' : $editData->price }}">
                        </div>

                    </div>
                </div>

                <div class="w-full mt-2">
                    <label class="text-[16px] font-semibold block  text-[#452C88]"
                        for="plan_price">@lang('lang.Plan_For')</label>
                    <select name="plan_for" id="plan_for">
                        <option value="" selected disabled>@lang('lang.Select_For')</option>
                        @if (isset($editData))
                            <option value="buyer" {{ $editData->plan_for == 'buyer' ? 'selected' : '' }}>
                                @lang('lang.Buyer')
                            </option>
                            <option value="seller" {{ $editData->plan_for == 'seller' ? 'selected' : '' }}>
                                @lang('lang.Seller')
                            </option>
                        @else
                            <option value="buyer">@lang('lang.Buyer')</option>
                            <option value="seller">@lang('lang.Seller')</option>
                        @endif

                    </select>
                </div>
                <div class="mt-2">
                    <div class="flex w-full lg:flex-row flex-col gap-5">
                        <div class="w-full mt-4">
                            <label class="text-[16px] font-semibold block  text-[#452C88]"
                                for="plan_options">@lang('lang.Plan_Options')</label>
                            <div class="flex gap-4">
                                <input type="text"
                                    value="{{ isset($editData) && isset($options[0]) ? $options[0] : '' }}"
                                    class="w-full mt-2 border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary h-[46px] text-[14px]"
                                    name="option[]" id="plan_options" placeholder="@lang('lang.Enter_Plan_Options')">
                                <button type="button"
                                    class="bg-primary text-white rounded-[4px] mt-2 px-4 py-2 addBtn font-semibold"
                                    id="addOption">
                                    +
                                </button>
                            </div>
                            @if (isset($editData))
                                <div id="inputContainer">
                                    @if (isset($options) && is_array($options))
                                        @foreach (array_slice($options, 1) as $option)
                                            <div class="flex gap-4 mt-2">
                                                <input type="text" value="{{ $option }}" name="option[]"
                                                    class="w-full mt-2 border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary h-[46px] text-[14px]" />

                                                <button type="button"
                                                    class="text-white rounded-[4px] mt-2 px-3.5 py-1.5 deleteBtn font-semibold bg-red-900">
                                                    <i class="fa-solid fa-trash text-white"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            @else
                                <div id="inputContainer"></div>
                            @endif
                        </div>

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
                        @lang(!isset($editData) ? 'lang.Save' : 'lang.Update')
                    </div>

                </button>
            </div>
        </div>
        </form>
        <div>

        </div>

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
@if (isset($editData))
    <script>
        $(document).ready(function() {
            $('#addcustomermodal').removeClass("hidden");
            $('#addcustomermodal').addClass("flex");
        });
    </script>
@endif
<script>
    document.getElementById('addOption').addEventListener('click', () => {
        // Create a new input element
        var newInput = document.createElement('input');
        newInput.type = 'text';
        newInput.name = 'option[]';
        newInput.placeholder = '@lang('lang.Enter_Plan_Options')';
        newInput.className =
            'w-full mt-2 border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary h-[46px] text-[14px]';

        // Create a new delete button
        var deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className =
            'text-white rounded-[4px] mt-2 px-3.5 py-1.5 deleteBtn font-semibold bg-red-900';
        deleteButton.innerHTML = '<i class="fa-solid fa-trash text-white"></i>';

        // Create a container div for the input and delete button
        var inputContainer = document.createElement('div');
        inputContainer.className = 'flex gap-4 mt-2';

        // Append the new input element and delete button to the container div
        inputContainer.appendChild(newInput);
        inputContainer.appendChild(deleteButton);

        // Append the container div to the main input container
        document.getElementById('inputContainer').appendChild(inputContainer);


        // Add an event listener to the delete button
        deleteButton.addEventListener('click', () => {
            inputContainer.remove();
        });

    });
    document.querySelectorAll('.deleteBtn').forEach(button => {
        button.addEventListener('click', function() {
            this.parentElement.remove();
        });
    });
    $(document).ready(function() {
        $("#subscriptionData").submit(function(event) {
            let url = $('#subscriptionData').attr('url');
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

                    window.location.href = '../subscriptionPlan';

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
            $('#plan_options').val() = '';
        });

        function deleteDatafun() {

            $('.delButton').click(function() {
                $('#deleteData').removeClass("hidden");
                var id = $(this).attr('delId');
                $('#delLink').attr('href', '../deleteSubscription/' + id);
            });

        }
        deleteDatafun();
        $('#datatable').on('draw.dt', function() {
            deleteDatafun();
        });
    });
</script>
