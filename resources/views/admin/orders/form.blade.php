<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        <div>
            <nav aria-label="Breadcrumb">
                <ol role="list" class="flex items-center space-x-1">
                    <li>
                        <div class="flex">
                            <a href="{{ route('admin.dashboard') }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">Dashboard</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="size-4 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <a href="{{ route('admin.orders.index') }}"
                                class="text-sm font-medium text-gray-500 hover:text-gray-700">Orders</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="size-4 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true" data-slot="icon">
                                <path fill-rule="evenodd"
                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span aria-current="page" class="text-sm font-medium text-gray-600">
                                @isset($order->id)
                                    Edit
                                @else
                                    Create
                                @endisset
                            </span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="mt-2 md:flex md:items-center md:justify-between">
                <div class="min-w-0 flex-1">
                    <h2 class="page-title">
                        @isset($order->id)
                            Edit {{ $order->name }}
                        @else
                            Create Order
                        @endisset
                    </h2>
                </div>
            </div>
        </div>


        <form method="post"
            action="{{ $order->id ? route('admin.orders.update', $order) : route('admin.orders.store') }}">
            @csrf

            @isset($order->id)
                @method('put')
            @endisset

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="order_number" class="control-label sm:pt-1.5">Order #</label>
                            <input type="text" name="order_number" id="order_number"
                                class="form-control @error('order_number') is-invalid @enderror"
                                value="{{ old('order_number', $order->order_number ?? $order->generateOrderNumber()) }}"
                                readonly />
                            @error('order_number')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="user_id" class="control-label sm:pt-1.5">User</label>
                            <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                                    <select name="user_id" id="user_id"
                                        class="col-start-1 row-start-1 form-select @error('user_id') is-invalid @enderror">
                                        <option value="">Select User</option>
                                        @foreach ($users as $key => $user)
                                            <option value="{{ $key }}" @selected(old('user_id', $order->user_id) == $key)>
                                                {{ $user }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                        viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            @error('user_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Order Items</h3>
                </div>
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto" x-data="orderItems">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr>
                                            <td width="50%">
                                                <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                                    <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                                                        <select :name="'items[' + index + '][product_id]'"
                                                            x-model="item.product_id"
                                                            class="col-start-1 row-start-1 form-select @error('user_id') is-invalid @enderror">
                                                            <option value="">Select Product</option>
                                                        </select>
                                                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4"
                                                            viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"
                                                            data-slot="icon">
                                                            <path fill-rule="evenodd"
                                                                d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                @error('user_id')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="quantity" id="quantity"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    :name="'items[' + index + '][quantity]'" x-model="item.quantity"
                                                    @input="updateTotal(index)" />
                                                @error('quantity')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="price" id="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    :name="'items[' + index + '][price]'" x-model="item.price"
                                                    @input="updateTotal(index)" />
                                                @error('price')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="number" name="total" id="total"
                                                    class="form-control @error('total') is-invalid @enderror"
                                                    :name="'items[' + index + '][total]'" x-model="item.total"
                                                    readonly />
                                                @error('total')
                                                    <p class="text-sm text-red-600">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="link-danger" @click="removeItem(index)"
                                                    x-show="items.length > 1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="size-5">
                                                        <path
                                                            d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                        <div class="border-t border-gray-200 text-center">
                            <button type="button" @click="addItem()" class="btn-secondary my-4">Add Item</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.orders.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>


    <script>
        function orderItems() {
            return {
                items: [{
                    product_id: '',
                    quantity: 1,
                    price: 0,
                    total: 0,
                }], // Array to hold order items


                // Method to add a new item
                addItem() {
                    this.items.push({
                        product_id: '',
                        quantity: 1,
                        price: 0,
                        total: 0,
                    });
                },

                // Method to remove an item
                removeItem(index) {
                    this.items.splice(index, 1);
                },

                updateTotal(index) {
                    const item = this.items[index];
                    item.total = item.quantity * item.price;
                },

                get grandTotal() {
                    return this.items.reduce((sum, item) => sum + item.total, 0);
                },
            };
        }
    </script>
</x-layouts.admin>
