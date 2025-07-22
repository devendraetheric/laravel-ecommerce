{{-- Search Form --}}
<form method="GET" class="mb-4 flex justify-end">
    <div class="flex items-center gap-2">
        <input type="search" name="query" value="{{ request('query') }}" placeholder="Search here..."
            class="form-control" />
        <button class="btn-secondary h-full !shadow-none">Search</button>
    </div>
</form>
