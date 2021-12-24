<x-slot name="title">
    <title>Processed Invoices</title>
</x-slot>

<div class="">
    @if (!$selectedInvoice)
        <div x-data="{showChicken:true}">


            <!--Title-->
            <h1
                class="flex items-center px-2 pb-4 font-serif text-2xl font-bold tracking-wide text-gray-600 break-normal dark:text-light md:text-2xl">
                Processed Invoices
            </h1>

            <div class="mb-12" style='border-bottom: 2px solid #eaeaea'>
                <ul class='flex text-xs cursor-pointer md:text-base '>
                    <li @click="showChicken=true" class='px-4 py-2 rounded-t-lg lg:px-8 '
                        :class="showChicken ? 'bg-blue-500 text-white ' : 'text-gray-500 bg-gray-200'">
                        Chicken Rearing Project
                    </li>
                    <li @click="showChicken=false" class='px-8 py-2 rounded-t-lg '
                        :class="showChicken == false ? 'bg-blue-500 text-white ' : 'text-gray-500 bg-gray-200'">
                        Corn Farming Project
                    </li>
                </ul>
            </div>

            <div class="container px-2 lg:mx-auto">

                <!--chicken project-->
                <section class="max-w-3xl antialiased text-gray-600 bg-gray-100 dark:bg-inherit" x-show="showChicken"
                    x-transition>
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full bg-white border border-gray-200 rounded-sm shadow-lg dark:bg-inherit">
                            <header class="flex flex-wrap px-5 py-4 border-b border-gray-100 lg:justify-between ">
                                <div class="">
                                    <h2 class="pt-4 text-lg font-semibold text-gray-800 dark:text-light">Chicken Rearing
                                        Project</h2>
                                </div>
                                <div class="">
                                    <div class="relative pt-2 mx-auto text-gray-600">
                                        <input
                                            class="h-10 px-5 pr-16 text-sm bg-white border-2 border-gray-300 rounded-lg focus:outline-none"
                                            type="search" name="search" placeholder="Search by name" autocomplete="off">
                                        <button type="submit" class="absolute top-0 right-0 mt-5 mr-4">
                                            <svg class="w-4 h-4 text-gray-600 fill-current"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                                style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                                width="512px" height="512px">
                                                <path
                                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead
                                            class="text-xs font-semibold text-gray-400 uppercase bg-gray-50 dark:bg-inherit dark:text-light">
                                            <tr>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Name</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Amount</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Date requested</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-center">Details</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                            @foreach ($chickenProject as $invoices)
                                                <tr class="dark:text-light hover:bg-blue-100 dark:hover:text-gray-600 ">
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="font-medium ">
                                                                {{ $invoices->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-left">
                                                            {{ number_format($invoices->amount) }}
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="font-medium text-left text-green-500">
                                                            {{ $invoices->created_at->diffForHumans() }}
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-lg text-center">
                                                            <button wire:click='setSelectedId({{ $invoices->id }})'
                                                                class="inline-block text-center ">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-6 h-6 text-blue-400" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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
                </section>

                <!--Corn project-->
                <section class="max-w-3xl antialiased text-gray-600 bg-gray-100 dark:bg-inherit" x-show="!showChicken"
                    x-transition>
                    <div class="flex flex-col justify-center h-full">
                        <!-- Table -->
                        <div class="w-full bg-white border border-gray-200 rounded-sm shadow-lg dark:bg-inherit">
                            <header class="flex flex-wrap px-5 py-4 border-b border-gray-100 lg:justify-between">
                                <div class="">
                                    <h2 class="pt-4 text-lg font-semibold text-gray-800 dark:text-light">Corn Farming
                                        Project</h2>
                                </div>
                                <div class="">
                                    <div class="relative pt-2 mx-auto text-gray-600">
                                        <input
                                            class="h-10 px-5 pr-16 text-sm bg-white border-2 border-gray-300 rounded-lg focus:outline-none"
                                            type="search" name="search" placeholder="Search by name" autocomplete="off">
                                        <button type="submit" class="absolute top-0 right-0 mt-5 mr-4">
                                            <svg class="w-4 h-4 text-gray-600 fill-current"
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1"
                                                x="0px" y="0px" viewBox="0 0 56.966 56.966"
                                                style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
                                                width="512px" height="512px">
                                                <path
                                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </header>
                            <div class="p-3">
                                <div class="overflow-x-auto">
                                    <table class="w-full table-auto">
                                        <thead
                                            class="text-xs font-semibold text-gray-400 uppercase bg-gray-50 dark:bg-inherit dark:text-light">
                                            <tr>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Name</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Acres</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-left">Date requested</div>
                                                </th>
                                                <th class="p-2 whitespace-nowrap">
                                                    <div class="font-semibold text-center">Details</div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm divide-y divide-gray-100">
                                            @foreach ($cornProject as $invoices)
                                                <tr class="dark:text-light hover:bg-blue-100 dark:hover:text-gray-600 ">
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="font-medium ">
                                                                {{ $invoices->name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-left">
                                                            {{ number_format($invoices->acres) }}
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="font-medium text-left text-green-500">
                                                            {{ $invoices->created_at->diffForHumans() }}
                                                        </div>
                                                    </td>
                                                    <td class="p-2 whitespace-nowrap">
                                                        <div class="text-lg text-center">
                                                            <button wire:click='setSelectedId({{ $invoices->id }})'
                                                                class="inline-block text-center ">
                                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                                    class="w-6 h-6 text-blue-400" fill="none"
                                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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
                </section>


            </div>
        </div>

    @else
        <div class="mb-4">
            <p class="text-lg font-bold text-green-500 cursor-pointer md:text-sm">&lt;&lt;
                <a wire:click="resetSelected"
                    class="text-base font-bold text-green-500 no-underline md:text-sm hover:underline">
                    GO BACK
                </a>
            </p>
        </div>

        <div class="">
            <h1
                class="flex items-center px-2 py-4 font-sans text-xl font-bold text-gray-600 break-normal md:text-2xl dark:text-light">
                Invoice Details
            </h1>

            <div class="">
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    Name : <span class="font-semibold">{{ $selectedInvoice->name }}</span>
                </p>
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    Project : <span
                        class="font-semibold">{{ $selectedInvoice->project == 1 ? 'Chicken Rearing Project' : 'Corn Farming Project' }}</span>
                </p>
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    {{ $selectedInvoice->project == 1 ? 'Amount' : 'Acres' }} :
                    <span class="font-semibold">
                        {{ $selectedInvoice->project == 1 ? number_format($selectedInvoice->amount) . ' Tshs' : $selectedInvoice->acres . ' Acres' }}
                    </span>
                </p>
                <p class="py-4 text-lg text-gray-700 dark:text-light">
                    Date Requested : <span
                        class="font-semibold">{{ $selectedInvoice->created_at->format('jS F Y') }}
                    </span>
                </p>
                <div class="mt-4 text-lg font-bold text-gray-600 dark:text-light">
                    Download Invoice :
                </div>
                <div class="flex flex-wrap mt-4">
                    @foreach (unserialize($selectedInvoice->invoices_path) as $path)
                        <div class="">
                            <div class="p-8 mr-8 bg-white rounded">
                                <svg class="w-6 h-5 text-blue-500" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path
                                        d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                                </svg>
                            </div>
                            <a wire:click="downloadInvoice('{{ $path }}')"
                                class="block mt-2 text-base text-blue-500 cursor-pointer hover:text-gray-400 dark:text-light">
                                Download
                            </a>
                        </div>

                    @endforeach
                </div>

    @endif



</div>
