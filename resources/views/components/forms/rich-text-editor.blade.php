<div x-data="editor(`{!! $slot !!}`)" class="overflow-hidden rounded-xl bg-white shadow-sm">
    <template x-if="isLoaded()">
        <div class="px-3 py-2 border-b border-gray-200">
            <div class="flex items-center gap-2">
                <button type="button" @click="setParagraph()"
                    :class="{ 'text-gray-900 bg-gray-100': isActive('paragraph', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="pilcrow" class="size-5"></i>
                </button>
                <button type="button" @click="toggleHeading({ level: 2 })"
                    :class="{ 'text-gray-900 bg-gray-100': isActive('heading', { level: 2 }, updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="heading-2" class="size-5"></i>
                </button>
                <button type="button" @click="toggleHeading({ level: 3 })"
                    :class="{ 'text-gray-900 bg-gray-100': isActive('heading', { level: 3 }, updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="heading-3" class="size-5"></i>
                </button>
                <button type="button" @click="toggleHeading({ level: 4 })"
                    :class="{ 'text-gray-900 bg-gray-100': isActive('heading', { level: 4 }, updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="heading-4" class="size-5"></i>
                </button>
                <button type="button" @click="toggleBold()"
                    :class="{ 'text-gray-900 bg-gray-100': isActive('bold', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="bold" class="size-5"></i>
                </button>
                <button type="button" @click="toggleItalic()"
                    :class="{ 'text-gray-900 bg-gray-100 ': isActive('italic', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="italic" class="size-5"></i>
                </button>
                <button type="button" @click="toggleUnderline()"
                    :class="{ 'text-gray-900 bg-gray-100 ': isActive('underline', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="underline" class="size-5"></i>
                </button>
                <button type="button" @click="toggleCode()"
                    :class="{ 'text-gray-900 bg-gray-100 ': isActive('code', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="code" class="size-5"></i>
                </button>
                <button type="button" @click="toggleBulletList()"
                    :class="{ 'text-gray-900 bg-gray-100 ': isActive('bulletList', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="list" class="size-5"></i>
                </button>
                <button type="button" @click="toggleOrderedList()"
                    :class="{ 'text-gray-900 bg-gray-100 ': isActive('orderedList', updatedAt) }"
                    class="p-2 text-gray-500 rounded-sm cursor-pointer hover:text-gray-900 hover:bg-gray-100">
                    <i data-lucide="list-ordered" class="size-5"></i>
                </button>
            </div>
        </div>
    </template>

    <div x-ref="element" class="prose max-w-none"></div>

    <input x-ref="hiddenInput" type="hidden" name="{{ $name }}" />
</div>
