@include('layouts.header')
@include('layouts.nav')
<div class="md:mx-4 mt-12">

    <div class="shadow-dark mt-3  rounded-xl pt-8  bg-white">
        <div>
            <div class="flex justify-end sm:justify-between  items-center px-[20px] mb-3">
                <h3 class="text-[20px] text-black hidden sm:block">@lang('lang.Inquiries')</h3>
                <div>


                </div>
            </div>
            <div class="overflow-x-auto">
                <table id="datatable">
                    <thead class="py-6 bg-primary text-white">
                        <tr>
                            <th class="whitespace-nowrap">@lang('lang.Sr')</th>
                            <th class="whitespace-nowrap">@lang('lang.Name')</th>
                            <th class="whitespace-nowrap">@lang('lang.Email')</th>
                            <th class="whitespace-nowrap">@lang('lang.Phone_Number')</th>
                            <th class="whitespace-nowrap">@lang('lang.Meassage')</th>
                            <th class="flex  justify-center">@lang('lang.Action')</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($inquiries as $x => $inquiry)
                            <tr class="pt-4">
                                <td>{{ $x + 1 }}</td>
                                <td>{{ $inquiry->name }}</td>
                                <td>{{ $inquiry->email }}</td>
                                <td>{{ $inquiry->subject }}</td>
                                <td>{{ $inquiry->message }}</td>
                                <td>

                                    <div class="flex gap-5 items-center justify-center">


                                        <a href=""><img width="38px"
                                                src="{{ asset('images/icons/edits.svg') }}" alt="update"></a>
                                        <a href="../delCustomer/{{ $data->id }}"> <img width="38px"
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

@include('layouts.footer')
