<x-layouts.admin>
    <div class="max-w-7xl mx-auto">

        @php
            $breadcrumbLinks = [
                [
                    'url' => route('admin.dashboard'),
                    'text' => 'Dashboard',
                ],
                [
                    'url' => route('admin.subscribers.index'),
                    'text' => 'Subscribers',
                ],
                [
                    'text' => $subscriber->id ? 'Edit' : 'Create',
                ],
            ];

            $title = $subscriber->id ? 'Edit ' . $subscriber->name : 'Create Subscriber';
        @endphp

        <x-admin.breadcrumb :links=$breadcrumbLinks :title=$title :goBackAction="route('admin.subscribers.index')" />

        <form method="post"
            action="{{ $subscriber->id ? route('admin.subscribers.update', $subscriber) : route('admin.subscribers.store') }}">
            @csrf

            @isset($subscriber->id)
                @method('put')
            @endisset

            <div class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label for="name" class="control-label">Name</label>
                            <input type="text" name="name" id="name"
                                value="{{ old('name', $subscriber->name) }}"
                                class="form-control @error('name') is-invalid @enderror" />
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label for="email" class="control-label">Email</label>
                            <input type="text" name="email" id="email"
                                value="{{ old('email', $subscriber->email) }}"
                                class="form-control @error('email') is-invalid @enderror" />
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 space-x-2">
                <button type="submit" class="btn-primary">Submit</button>
                <a href="{{ route('admin.subscribers.index') }}" class="btn-secondary">Cancel</a>
            </div>
        </form>
    </div>

</x-layouts.admin>
