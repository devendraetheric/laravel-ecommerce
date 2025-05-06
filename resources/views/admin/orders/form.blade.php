<x-layouts.admin>
    <div class="max-w-7xl mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.orders.index'),
                    'text' => 'Orders',
                ],
                [
                    'text' => $order->id ? 'Edit' : 'Create',
                ],
            ];
            $title = $order->id ? 'Edit ' . $order->order_number : 'Create Order';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.orders.index')" />

        <form method="post"
            action="{{ $order->id ? route('admin.orders.update', $order) : route('admin.orders.store') }}"
            x-data="orderItems">
            @csrf

            @isset($order->id)
                @method('put')
            @endisset

            <div class="mt-6 rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Order Information</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="space-y-2 col-span-3 md:col-span-1">
                            <label for="order_number" class="control-label">Order #</label>
                            <input type="text" name="order_number" id="order_number"
                                class="form-control @error('order_number') is-invalid @enderror"
                                value="{{ old('order_number', $order->order_number ?? $order->generateOrderNumber()) }}"
                                readonly />
                            @error('order_number')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-3 md:col-span-1">
                            <label for="order_date" class="control-label">Order Date</label>
                            <input type="date" name="order_date" id="order_date"
                                class="form-control @error('order_date') is-invalid @enderror"
                                value="{{ old('order_date', $order->order_date?->format('Y-m-d') ?? now()->format('Y-m-d')) }}" />
                            @error('order_date')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="user_name" class="control-label">User</label>
                            <div class="relative" x-data="userCombobox()">
                                <input x-model="query" @input="searchUsers" @focus="open = !open"
                                    @keydown.arrow-down.prevent="highlightNext()"
                                    @keydown.arrow-up.prevent="highlightPrev()"
                                    @keydown.enter.prevent="selectHighlighted()" id="user_combobox" type="text"
                                    name="user_name" id="user_name"
                                    class="form-control @error('user_id') is-invalid @enderror" role="combobox"
                                    :aria-expanded="open" autocomplete="off">
                                <input type="hidden" name="user_id" id="user_id" x-model="selectedId" />
                                <button type="button"
                                    class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
                                    @click="open = !open">
                                    <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor"
                                        aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd"
                                            d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>

                                <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                                    role="listbox" x-show="open && results.length" @click.away="open = !open">
                                    <template x-for="(item, i) in results" :key="item.id">
                                        <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none"
                                            id="option-0" role="option" tabindex="-1"
                                            :class="{
                                                'text-white bg-primary-600 outline-hidden': selectedId == item
                                                    .id,
                                                'text-white bg-primary-600 outline-hidden': highlighted == i,
                                            }"
                                            @click="selectUser(item)" @mouseenter="highlighted = i">
                                            <span class="block truncate"
                                                :class="{
                                                    'font-semibold': selectedId == item.id
                                                }"
                                                x-text="item.name"></span>
                                            <span
                                                class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600"
                                                :class="{
                                                    'text-white': selectedId == item.id,
                                                    'text-white': highlighted == i,
                                                }">
                                                <svg class="size-5" viewBox="0 0 20 20" fill="currentColor"
                                                    aria-hidden="true" data-slot="icon">
                                                    <path fill-rule="evenodd"
                                                        d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                            @error('user_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-3 md:col-span-1">
                            <label for="status" class="control-label">Status</label>
                            <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">
                                    <select name="status" id="status"
                                        class="col-start-1 row-start-1 form-select @error('status') is-invalid @enderror">
                                        <option value="">Select Status</option>
                                        @foreach (\App\Enums\OrderStatus::cases() as $status)
                                            <option value="{{ $status->value }}" @selected(old('status', $order->status->value ?? 'new') == $status->value)>
                                                {{ $status->label() }}
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
                            @error('status')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.orders.address', ['address' => $order?->address])

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Order Items</h3>
                </div>
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Unit Price</th>
                                        <th scope="col">Total Amount</th>
                                        <th scope="col">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <template x-for="(item, index) in items" :key="index">
                                        <tr>
                                            <td width="50%">
                                                <div class="sm:grid sm:grid-cols-6 sm:items-start sm:gap-4">
                                                    <div class="mt-2 sm:col-span-6 sm:mt-0 grid grid-cols-1">

                                                        <div class="relative" x-data="productCombobox(index)">
                                                            <input x-model="query" @input="searchProducts"
                                                                @focus="open = !open"
                                                                @keydown.arrow-down.prevent="highlightNext()"
                                                                @keydown.arrow-up.prevent="highlightPrev()"
                                                                @keydown.enter.prevent="selectHighlighted()"
                                                                id="product_combobox" type="text"
                                                                name="product_name" id="product_name"
                                                                class="form-control @error('product_id') is-invalid @enderror"
                                                                role="combobox" :aria-expanded="open"
                                                                autocomplete="off">

                                                            <input type="hidden"
                                                                :name="'items[' + index + '][product_id]'"
                                                                id="product_id" x-model="selectedId" />

                                                            <input type="hidden" :name="'items[' + index + '][name]'"
                                                                x-model="query" />

                                                            <button type="button"
                                                                class="absolute inset-y-0 right-0 flex items-center rounded-r-lg px-2 focus:outline-hidden"
                                                                @click="open = !open">
                                                                <svg class="size-5 text-gray-400" viewBox="0 0 20 20"
                                                                    fill="currentColor" aria-hidden="true"
                                                                    data-slot="icon">
                                                                    <path fill-rule="evenodd"
                                                                        d="M10.53 3.47a.75.75 0 0 0-1.06 0L6.22 6.72a.75.75 0 0 0 1.06 1.06L10 5.06l2.72 2.72a.75.75 0 1 0 1.06-1.06l-3.25-3.25Zm-4.31 9.81 3.25 3.25a.75.75 0 0 0 1.06 0l3.25-3.25a.75.75 0 1 0-1.06-1.06L10 14.94l-2.72-2.72a.75.75 0 0 0-1.06 1.06Z"
                                                                        clip-rule="evenodd" />
                                                                </svg>
                                                            </button>

                                                            <ul class="absolute z-100 mt-1 max-h-60 w-full overflow-auto rounded-lg bg-white py-1 text-base shadow-lg ring-1 ring-black/5 focus:outline-hidden sm:text-sm"
                                                                role="listbox" x-show="open && results.length"
                                                                @click.away="open = !open">
                                                                <template x-for="(item, i) in results"
                                                                    :key="item.id">
                                                                    <li class="relative cursor-default py-2 pr-9 pl-3 text-gray-900 select-none"
                                                                        id="option-0" role="option" tabindex="-1"
                                                                        :class="{
                                                                            'text-white bg-primary-600 outline-hidden': selectedId ==
                                                                                item
                                                                                .id,
                                                                            'text-white bg-primary-600 outline-hidden': highlighted ==
                                                                                i,
                                                                        }"
                                                                        @click="selectProduct(item)"
                                                                        @mouseenter="highlighted = i">
                                                                        <span class="block truncate"
                                                                            :class="{
                                                                                'font-semibold': selectedId == item.id
                                                                            }"
                                                                            x-text="item.name"></span>
                                                                        <span
                                                                            class="absolute inset-y-0 right-0 flex items-center pr-4 text-primary-600"
                                                                            :class="{
                                                                                'text-white': selectedId == item.id,
                                                                                'text-white': highlighted == i,
                                                                            }">
                                                                            <svg class="size-5" viewBox="0 0 20 20"
                                                                                fill="currentColor" aria-hidden="true"
                                                                                data-slot="icon">
                                                                                <path fill-rule="evenodd"
                                                                                    d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                                                                    clip-rule="evenodd" />
                                                                            </svg>
                                                                        </span>
                                                                    </li>
                                                                </template>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-sm text-red-600"
                                                    x-text="getValidationError(index, 'product_id')">
                                                </p>
                                            </td>
                                            <td>
                                                <input type="number" name="quantity" id="quantity"
                                                    class="form-control @error('quantity') is-invalid @enderror"
                                                    :name="'items[' + index + '][quantity]'" x-model="item.quantity"
                                                    @input="updateTotal(index)" />
                                            </td>
                                            <td>
                                                <input type="number" name="price" id="price"
                                                    class="form-control @error('price') is-invalid @enderror"
                                                    :name="'items[' + index + '][price]'" x-model="item.price"
                                                    @input="updateTotal(index)" step="any" />

                                            </td>
                                            <td>
                                                <input type="number" name="total" id="total"
                                                    class="form-control @error('total') is-invalid @enderror"
                                                    :name="'items[' + index + '][total]'" x-model="item.total"
                                                    readonly />
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="link-danger" @click="removeItem(index)"
                                                    x-show="items.length > 1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                        fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd"
                                                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                            clip-rule="evenodd" />
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

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-base font-semibold text-gray-800">Order Summary</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="sub_total" class="control-label">Sub Total</label>
                            <input type="text" name="sub_total" id="sub_total"
                                class="form-control @error('sub_total') is-invalid @enderror"
                                :value="grandTotal.toFixed(2)" readonly />
                            @error('sub_total')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2 md:col-span-1">
                            <label for="grand_total" class="control-label">Grand Total</label>
                            <input type="text" name="grand_total" id="grand_total"
                                class="form-control @error('grand_total') is-invalid @enderror"
                                :value="grandTotal.toFixed(2)" readonly />
                            @error('grand_total')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2 col-span-2">
                            <label for="notes" class="control-label">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes', $order->notes) }}</textarea>
                            @error('notes')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
                <a href="{{ route('admin.orders.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            window.validationErrors = @json($errors->toArray());

            function getValidationError(index, field) {
                const key = `items.${index}.${field}`;
                return window.validationErrors && window.validationErrors[key] ?
                    window.validationErrors[key][0] :
                    '';
            }

            @php
                $formItems = $order->items->map(function ($item) {
                    $item->name = $item->product->name;

                    return $item->only(['product_id', 'name', 'quantity', 'price', 'total']);
                });
            @endphp

            var formItems = @json(old('items', $formItems->toArray() ?? []));

            function orderItems() {
                // Initialize items with existing order items or an empty array

                if (formItems.length == 0) {
                    formItems.push({
                        product_id: '',
                        quantity: 1,
                        price: 0,
                        total: 0,
                    })
                }

                return {
                    items: formItems, // Array to hold order items

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
                        item.total = parseFloat(item.quantity * item.price).toFixed(2);
                    },

                    get grandTotal() {
                        return this.items.reduce((sum, item) => sum + parseFloat(item.total), 0);
                    },
                };
            }

            function userCombobox() {
                return {
                    open: false,
                    query: "{{ old('user_name', $order->user->name ?? '') }}",
                    results: [],
                    highlighted: -1,
                    selectedId: "{{ old('user_id', $order->user_id) }}",
                    searchUsers() {
                        if (this.query.length < 1) {
                            this.results = [];
                            return;
                        }
                        fetch(`{{ route('admin.users.search') }}?q=${encodeURIComponent(this.query)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.results = data;
                                this.highlighted = -1;
                                this.selectedId = "";
                            });
                    },
                    highlightNext() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted + 1) % this.results.length;
                    },
                    highlightPrev() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted - 1 + this.results.length) % this.results.length;
                    },
                    selectHighlighted() {
                        if (this.highlighted >= 0 && this.results[this.highlighted]) {
                            this.selectUser(this.results[this.highlighted]);
                        }
                    },
                    selectUser(item) {
                        this.query = item.name;
                        this.selectedId = item.id;
                        this.open = false;
                    }
                }
            }


            function productCombobox(index) {

                return {
                    open: false,
                    query: formItems[index]['name'] ?? '',
                    results: [],
                    highlighted: -1,
                    selectedId: formItems[index]['product_id'] ?? '',

                    searchProducts() {

                        if (this.query.length < 1) {
                            this.results = [];
                            return;
                        }
                        fetch(`{{ route('admin.products.search') }}?q=${encodeURIComponent(this.query)}`)
                            .then(res => res.json())
                            .then(data => {
                                this.results = data;
                                this.highlighted = -1;
                                this.selectedId = "";
                            });
                    },


                    highlightNext() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted + 1) % this.results.length;
                    },
                    highlightPrev() {
                        if (this.results.length === 0) return;
                        this.highlighted = (this.highlighted - 1 + this.results.length) % this.results.length;
                    },
                    selectHighlighted() {
                        if (this.highlighted >= 0 && this.results[this.highlighted]) {
                            this.selectProduct(this.results[this.highlighted]);
                        }
                    },
                    selectProduct(item) {
                        this.query = item.name;
                        this.selectedId = item.id;
                        this.open = false;
                    }
                }
            }
        </script>
    @endpush
</x-layouts.admin>
