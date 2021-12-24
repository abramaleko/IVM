<x-slot name="title">
    <title>Processed Invoices</title>
</x-slot>

<x-slot name="styles">
    <!--Regular Datatables CSS-->
    <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" rel="stylesheet">
    <!--Responsive Extension Datatables CSS-->
    <link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/datatables.css') }}">
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

            <div class="container px-2 lg:mx-auto" style="width: 50rem;">

                <!--chicken project-->
                <div id='recipients' class="p-8 mt-6 bg-white rounded shadow lg:mt-0" x-show="showChicken" x-transition
                    wire:ignore>
                    <table id="example" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1">Name</th>
                                <th data-priority="2">Project</th>
                                <th data-priority="3">Amount</th>
                                <th data-priority="4">Date requested</th>
                                <th data-priority="5">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($chickenProject as $invoices)
                                <tr>
                                    <td class="px-4">{{ $invoices->name }}</td>
                                    <td class="px-4 tracking-tight">
                                        {{ $invoices->project == 1 ? 'Chicken Rearing Project' : 'Corn Farming Project' }}
                                    </td>
                                    <td class="px-4">{{ number_format($invoices->amount) }}</td>
                                    <td class="text-center">{{ $invoices->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <button wire:click='setSelectedId({{ $invoices->id }})'
                                            class="inline-block text-center ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

                <!--Corn project-->
                <div id='recipients' class="p-8 mt-6 bg-white rounded shadow lg:mt-0" x-show="!showChicken" x-transition
                    wire:ignore>
                    <table id="example2" class="stripe hover"
                        style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1">Name</th>
                                <th data-priority="2">Project</th>
                                <th data-priority="3">Acres</th>
                                <th data-priority="4">Date requested</th>
                                <th data-priority="5">Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cornProject as $invoices)
                                <tr>
                                    <td class="px-4">{{ $invoices->name }}</td>
                                    <td class="px-4 tracking-tight">
                                        {{ $invoices->project == 1 ? 'Chicken Rearing Project' : 'Corn Farming Project' }}
                                    </td>
                                    <td class="text-center">{{ $invoices->acres }}</td>
                                    <td class="text-center">{{ $invoices->created_at->diffForHumans() }}</td>
                                    <td class="text-center">
                                        <button wire:click='setSelectedId({{ $invoices->id }})'
                                            class="inline-block text-center ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>
                </div>


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
                             <svg class="w-6 h-5 text-blue-500" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                 <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                             </svg>
                         </div>
                           <a wire:click="downloadInvoice('{{$path}}')" class="block mt-2 text-base text-blue-500 cursor-pointer hover:text-gray-400 dark:text-light">
                             Download
                           </a>
                     </div>

                     @endforeach
                 </div>

    @endif



</div>





<x-slot name="scripts">
    <!-- jQuery -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <!--Datatables -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script>
        $(document).ready(function() {

            var table = $('#example').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();


            var table2 = $('#example2').DataTable({
                    responsive: true
                })
                .columns.adjust()
                .responsive.recalc();

        });
    </script>
</x-slot>
