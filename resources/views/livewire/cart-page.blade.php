<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row gap-4">
            <div class="md:w-3/4">
                <!-- Card -->
                <div class="flex flex-col">
                  <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                      <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-neutral-800 dark:border-neutral-700">
                        <!-- Header -->
                        <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-neutral-700">
                          <div>
                            <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                              Shopping Cart
                            </h2>
                          </div>
                        </div>
                        <!-- End Header -->

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
                              <th scope="col" class="px-6 py-3 text-start">
                                <div class="flex items-center gap-x-2">
                                  <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-neutral-200">
                                    Action
                                  </span>
                                </div>
                              </th>
                              <th scope="col" class="px-6 py-3 text-end"></th>
                            </tr>
                          </thead>

                          <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                              @forelse($cart_items as $item)
                                <tr wire:key="{{ $item['product_id'] }}">
                                  <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                      <div class="flex items-center gap-x-3">
                                        <img class="inline-block size-[38px] rounded-sm" src="{{ url('storage', $item['image']) }}" alt="{{$item['name']}}">
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
                                      <button wire:click="decreaseQty({{ $item['product_id'] }})" class="border rounded-md py-2 px-4 mr-2">-</button>
                                      <span class="text-center w-8">{{ $item['quantity']}}</span>
                                      <button wire:click="increaseQty({{ $item['product_id'] }})" class="border rounded-md py-2 px-4 ml-2">+</button>
                                    </div>
                                  </td>
                                  <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-3">
                                      <span class="py-1 px-1.5 inline-flex items-center gap-x-1 text-xs font-medium bg-teal-100 text-teal-800 rounded-md dark:bg-teal-500/10 dark:text-teal-500">
                                        {{Number::currency($item['total_amount'], 'BDT')}}
                                      </span>
                                    </div>
                                  </td>
                                  <td class="size-px whitespace-nowrap">
                                    <div class="px-6 py-1.5">
                                      <button wire:click="removeItem({{ $item['product_id'] }})" class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm-1.72 6.97a.75.75 0 1 0-1.06 1.06L10.94 12l-1.72 1.72a.75.75 0 1 0 1.06 1.06L12 13.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L13.06 12l1.72-1.72a.75.75 0 1 0-1.06-1.06L12 10.94l-1.72-1.72Z" clip-rule="evenodd" />
                                        </svg>
                                      </button>
                                    </div>
                                  </td>
                                </tr>
                              @empty
                                <tr>
                                  <td colspan="5" class="text-center py-4 font-semibold text-slate-500">No Items are avilable in Cart</td>
                                </tr>
                              @endforelse
                          </tbody>
                        </table>
                        <!-- End Table -->

                        <!-- Footer -->
                        <!-- <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-neutral-700">
                          <div>
                            <p class="text-sm text-gray-600 dark:text-neutral-400">
                              <span class="font-semibold text-gray-800 dark:text-neutral-200">12</span> results
                            </p>
                          </div>

                          <div>
                            <div class="inline-flex gap-x-2">
                              <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                                Prev
                              </button>

                              <button type="button" class="py-1.5 px-2 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800">
                                Next
                                <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                              </button>
                            </div>
                          </div>
                        </div> -->
                        <!-- End Footer -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End Card -->
            </div>

            <div class="md:w-1/4">
                <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold mb-4">Summary</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>{{Number::currency($grand_total)}}</span>
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
                    <span class="font-semibold">{{Number::currency($grand_total, 'BDT')}}</span>
                </div>
                    @if($cart_items)
                        <button class="bg-blue-500 text-white py-2 px-4 rounded-lg mt-4 w-full">Checkout</button>
                    @endif
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

