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

                                        <a href=""><img width="38px"
                                                src="{{ asset('images/icons/edits.svg') }}" alt="update"></a>
                                        <a href=""> <img width="38px"
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

<div id="addcustomermodal" data-modal-backdrop="static"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0  left-0 z-50 justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full ">
    <div class="relative p-4 w-full  rounded-3xl  max-w-3xl max-h-full ">
        <form action="../addSubscription" method="post" enctype="multipart/form-data">
            @csrf
            <div class="relative bg-white shadow-dark rounded-lg  dark:bg-gray-700  ">
                <div class="flex items-center   justify-start  p-5  rounded-t dark:border-gray-600 bg-primary">
                    <h3 class="text-xl font-semibold text-white ">
                        @lang('lang.Add_Plan')
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


                <div class="p-5">
                    <div class="">
                        <div class="flex w-full lg:flex-row flex-col gap-5">
                            <div class="w-full mt-4">
                                <label class="text-[16px] font-semibold block  text-[#452C88]"
                                    for="plan_name">@lang('lang.Plan_Name')</label>
                                <input type="text"
                                    class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                    name="name" id="plan_name" placeholder="@lang('lang.Enter_Plan_Name')">
                            </div>
                            <div class="w-full lg:mt-4">
                                <label class="text-[16px] font-semibold block  text-[#452C88]"
                                    for="plan_price">@lang('lang.Plan_Price')</label>
                                <input type="text"
                                    class="w-full mt-2  border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary   h-[46px] text-[14px]"
                                    name="price" id="plan_price" placeholder="@lang('lang.Plan_Price')">
                            </div>

                        </div>
                    </div>

                    <div class="w-full mt-2">
                        <label class="text-[16px] font-semibold block  text-[#452C88]"
                            for="plan_price">@lang('lang.Plan_For')</label>
                        <select name="plan_for" id="plan_for">
                            <option value="" selected disabled>@lang('lang.Select_For')</option>
                            <option value="buyer">@lang('lang.Buyer')</option>
                            <option value="seller">@lang('lang.Seller')</option>
                        </select>
                    </div>
                    <div class="mt-2">
                        <div class="flex w-full lg:flex-row flex-col gap-5">
                            <div class="w-full mt-4">
                                <label class="text-[16px] font-semibold block  text-[#452C88]"
                                    for="plan_options">@lang('lang.Plan_Options')</label>

                                <div id="inputContainer"></div>
                                <div class="flex gap-4">
                                    <input type="text"
                                        class="w-full mt-2 border-2 border-[#DEE2E6] rounded-[6px] focus:border-primary h-[46px] text-[14px]"
                                        name="option[]" id="plan_options" placeholder="@lang('lang.Enter_Plan_Options')">
                                    <button type="button"
                                        class="bg-primary text-white rounded-[4px] mt-2 px-4 py-2 addBtn font-semibold"
                                        id="addOption">
                                        +
                                    </button>
                                </div>

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





@include('layouts.footer')
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
</script>
