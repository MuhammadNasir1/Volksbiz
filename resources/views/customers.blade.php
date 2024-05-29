@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">
    <div>
        <h1 class=" font-semibold   text-2xl ">@lang('lang.All_Customers')</h1>
    </div>
    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Customers_List')</h3>
                <div>


                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Phone_Number')</th>
                            <th class="whitespace-nowrap">@lang('lang.Email')</th>
                            <th class="whitespace-nowrap">@lang('lang.Address')</th>
                            <th class="whitespace-nowrap">@lang('lang.Subscription_Plan')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>

                        <td>01</td>
                        <td>M-Arham Waheed</td>
                        <td>123-456-789</td>
                        <td>customer@gmail.com</td>
                        <td>Town , City</td>
                        <td>Basic</td>
                        <td>
                            <div class="flex gap-5 items-center justify-center">
                                <a href=""><img width="38px" src="{{ asset('images/icons/edits.svg') }}"
                                        alt="update"></a>
                                <a href=""> <img width="38px" src="{{ asset('images/icons/delete.svg') }}"
                                        alt="Delete"></a>

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

@include('layouts.footer')
