<form {{ $attributes->merge(['method' => 'POST', 'class' => 'inline']) }}
    onsubmit="return confirm('Are you sure want to delete?')">
    @csrf
    @method('DELETE')
    <button class="link-danger relative inline-flex cursor-pointer">
        <i data-lucide="trash-2" class="size-5"></i>
    </button>
</form>
