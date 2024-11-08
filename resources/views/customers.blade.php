@extends('layouts.layout')
@section('title')
    Customers
@endsection

@section('content')
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
                @php
                    $headers = [
                        __('lang.Sr'),
                        __('lang.Name'),
                        __('lang.Phone_Number'),
                        __('lang.Email'),
                        __('lang.Address'),
                        __('lang.Subscription_Plan'),
                        __('lang.Action'),
                    ];
                @endphp
                <x-table :headers="$headers">
                    <x-slot name="tablebody">
                        @foreach ($customers as $x => $data)
                            <tr class="pt-4">
                                <td>{{ $x + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->phone }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->role }}</td>
                                <td>{{ $data->package }}</td>
                                <td>

                                    <div class="flex gap-5 items-center justify-center">


                                        <a href=""><img width="38px" src="{{ asset('images/icons/edits.svg') }}"
                                                alt="update"></a>
                                        <a href="../delCustomer/{{ $data->id }}"> <img width="38px"
                                                src="{{ asset('images/icons/delete.svg') }}" alt="Delete"></a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-table>
            </div>
        </div>
    </div>
@endsection
