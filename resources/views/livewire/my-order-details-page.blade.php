<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
  <h1 class="text-4xl font-bold text-slate-500">Order Details</h1>

  <!-- Grid -->
  <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <circle cx="9" cy="7" r="4" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Customer
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <div>{{$address->full_name}}</div>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 22h14" />
            <path d="M5 2h14" />
            <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
            <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Order Date
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
              {{$address->created_at->format('d-m-Y')}}
            </h3>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
            <path d="m12 12 4 10 1.7-4.3L22 16Z" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Order Status
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            @php
              $status = '';
              if($order->status == 'new'){
                $status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow capitalize">New</span>';
              }
              if($order->status == 'processing'){
                $status = '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow capitalize">Processing</span>';
              }
              if($order->status == 'shipped'){
                $status = '<span class="bg-orange-500 py-1 px-3 rounded text-white shadow capitalize">Shipped</span>';
              }
              if($order->status == 'delivered'){
                $status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow capitalize">Delivered</span>';
              }
              if($order->status == 'canceled'){
                $status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow capitalize">cancelled</span>';
              }
            @endphp
            <span>{!! $status !!}</span>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->

    <!-- Card -->
    <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
      <div class="p-4 md:p-5 flex gap-x-4">
        <div class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
          <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
            <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
            <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
            <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
          </svg>
        </div>

        <div class="grow">
          <div class="flex items-center gap-x-2">
            <p class="text-xs uppercase tracking-wide text-gray-500">
              Payment Status
            </p>
          </div>
          <div class="mt-1 flex items-center gap-x-2">
            @php
              $payment_status='';
                if($order->payment_status == 'paid'){
                  $payment_status = '<span class="bg-green-500 py-1 px-3 rounded text-white shadow capitalize">paid</span>';
                }
                if($order->payment_status == 'failed'){
                  $payment_status = '<span class="bg-red-500 py-1 px-3 rounded text-white shadow capitalize">failed</span>';
                }
                if($order->payment_status == 'pending'){
                  $payment_status = '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow capitalize">pending</span>';
                }
            @endphp
            <span>{!! $payment_status !!}</span>
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Grid -->

  <div class="flex flex-col md:flex-row gap-4 mt-4">
    <div class="md:w-3/4">
      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <div class="flex flex-col">
          <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
              <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                <!-- Table -->
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                  <thead class="bg-gray-50 dark:bg-neutral-800">
                    <tr>
                      <th scope="col" class="ps-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                            Product
                          </span>
                        </div>
                      </th>
                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                            Price
                          </span>
                        </div>
                      </th>
                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                            Quantity
                          </span>
                        </div>
                      </th>
                      <th scope="col" class="px-6 py-3 text-start">
                        <div class="flex items-center gap-x-2">
                          <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                            Total
                          </span>
                        </div>
                      </th>
                      
                      <th scope="col" class="px-6 py-3 text-end"></th>
                    </tr>
                  </thead>

                  <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                      @foreach($order_items as $item)
                        <tr wire:key="{{ $item->id }}">
                          <td class="size-px whitespace-nowrap">
                            <div class="px-6 py-3">
                              <div class="flex items-center gap-x-3">
                                <img class="inline-block size-[38px] rounded-sm" src="{{ url('storage', $item->product->images[0] )}}" alt="{{ $item -> name}}">
                                <div class="grow">
                                  <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">{{ $item['name']}}</span>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="h-px w-72 whitespace-nowrap">
                            <div class="px-6 py-3">
                              <span class="block text-sm font-semibold text-gray-800 dark:text-neutral-200">Unit Price</span>
                              <span class="block text-sm text-gray-500 dark:text-neutral-500">{{Number::currency($item['unit_amount'], 'BDT')}}</span>
                            </div>
                          </td>
                          <td class="h-px w-72 whitespace-nowrap">
                            <div class="px-6 py-3">
                              <span class="text-center w-8">{{ $item['quantity']}}</span>
                            </div>
                          </td>
                          <td class="size-px whitespace-nowrap">
                            <div class="px-6 py-3">
                              <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-md dark:bg-teal-500/10 dark:text-teal-500">
                                {{Number::currency($item['total_amount'], 'BDT')}}
                              </span>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
                <!-- End Table -->
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4">
        <h1 class="font-3xl font-bold text-slate-500 mb-3">Shipping Address</h1>
        <div class="flex justify-between items-center">
          <div>
            <p>{{$address->street_address}}, {{$address->city}}, {{$address->state}}, {{$address->zip_code}}</p>
          </div>
          <div>
            <p class="font-semibold">Phone:</p>
            <p>{{$address->phone}}</p>
          </div>
        </div>
      </div>

    </div>
    <div class="md:w-1/4">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-lg font-semibold mb-4">Summary</h2>
        <div class="flex justify-between mb-2">
          <span>Subtotal</span>
          <span>{{Number::currency($item->order->grand_total, 'BDT')}}</span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Taxes</span>
          <span>{{Number::currency(0, 'BDT')}}</span>
        </div>
        <div class="flex justify-between mb-2">
          <span>Shipping</span>
          <span>{{Number::currency(0, 'BDT')}}</span>
        </div>
        <hr class="my-2">
        <div class="flex justify-between mb-2">
          <span class="font-semibold">Grand Total</span>
          <span class="font-semibold">{{Number::currency($item->order->grand_total, 'BDT')}}</span>
        </div>

      </div>
    </div>
  </div>
</div>
