<div x-data="editor(`{!! $slot !!}`)" class="mt-6 overflow-hidden rounded-xl bg-white shadow-sm">
    <template x-if="isLoaded()">
        <div class="px-3 py-2 border-b border-gray-200">
            <div class="flex items-center gap-2">
                <button type="button" @click="toggleHeading({ level: 1 })"
                    :class="{ 'is-active': isActive('heading', { level: 2 }, updatedAt) }">
                    H2
                </button>
                <button type="button" @click="toggleBold()" :class="{ 'is-active': isActive('bold', updatedAt) }">
                    Bold
                </button>
                <button type="button" @click="toggleItalic()"
                    :class="{ 'text-gray-900 bg-gray-100 ': isActive('italic', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100 ">
                    Italic
                </button>
            </div>
        </div>
    </template>

    <div x-ref="element" class="prose max-w-none"></div>

    <input x-ref="hiddenInput" type="hidden" name="{{ $name }}" />
</div>
