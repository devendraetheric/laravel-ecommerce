<x-layouts.admin>

    <div class="mx-auto">
        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.contactQueries.index'),
                    'text' => 'Contact Queries',
                ],
                [
                    'text' => 'List',
                ],
            ];
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks title="Contact Queries" />


        <div class="mt-8 flow-root" x-data="contactQueryModal()">
            <x-admin.table.search />

            {{-- Contact Query Table --}}
            <div class="overflow-hidden rounded-xl bg-white border border-gray-200">
                <div class="p-6">
                    <div class="-mx-6 -my-6 overflow-x-auto">
                        <div class="inline-block min-w-full align-middle">
                            <table class="record-table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col" class="relative">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($contactQueries as $contactQuery)
                                        <tr>
                                            <td class="!font-semibold">{{ $contactQuery->name }}</td>
                                            <td>{{ $contactQuery->email }}</td>
                                            <td>{{ $contactQuery->phone }}</td>
                                            <td>{{ $contactQuery->subject }}</td>

                                            {{-- Actions --}}

                                            <td class="relative text-right text-sm space-x-1 items-center">

                                                <button class="link-primary"
                                                    @click="showModal({
                                                        name: '{{ addslashes($contactQuery->name) }}',
                                                        email: '{{ addslashes($contactQuery->email) }}',
                                                        phone: '{{ addslashes($contactQuery->phone) }}',
                                                        subject: '{{ addslashes($contactQuery->subject) }}',
                                                        message: `{{ addslashes($contactQuery->message) }}`
                                                    })">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="size-5 ">
                                                        <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                        <path fill-rule="evenodd"
                                                            d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>

                                                <x-admin.links.delete :action="route('admin.contactQueries.destroy', $contactQuery)" />
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Records found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <!-- Shared Modal -->
                            <div x-on:keydown.escape.window="open = false" x-show="open" x-transition
                                @click.away="close()"
                                class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500/75" x-cloak>

                                <div @click.stop class="bg-white p-6 rounded shadow w-1/3">
                                    <h2 class="text-lg font-semibold mb-4">Contact Query Details</h2>
                                    <p><strong>Name:</strong> <span x-text="data.name"></span></p>
                                    <p><strong>Email:</strong> <span x-text="data.email"></span></p>
                                    <p><strong>Phone:</strong> <span x-text="data.phone"></span></p>
                                    <p><strong>Subject:</strong> <span x-text="data.subject"></span></p>
                                    <p><strong>Message:</strong> <span x-text="data.message"></span></p>
                                    <button @click="close()"
                                        class="mt-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Close</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            {!! $contactQueries->links() !!}
        </div>
    </div>

    @push('scripts')
        <script>
            function contactQueryModal() {
                return {
                    open: false,
                    data: {
                        name: '',
                        email: '',
                        phone: '',
                        subject: '',
                        message: '',
                    },
                    showModal(query) {
                        this.data = query;
                        this.open = true;
                    },
                    close() {
                        this.open = false;
                    }
                };
            }
        </script>
    @endpush
</x-layouts.admin>
