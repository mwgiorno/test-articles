<script setup>

class SortableState {
    static states = ['asc', 'desc'];

    constructor(value) {
        this.index = 0;       
    }

    next () {
        this.index++;
        if (this.index >= SortableState.states.length) {
            this.index = 0;
        }
    };

    get value() {
        return SortableState.states[this.index];
    }
};

const props = defineProps({
    columnName: String
})

const state = new SortableState();

const emit = defineEmits(['changeState']);

function changeState() {
    state.next();
    emit('changeState', props.columnName, state.value);
};

</script>

<template>
    <th @click="changeState" scope="col" class=" px-6 py-3 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
        <div class="flex items-center gap-x-2 hover:text-indigo-500 cursor-pointer">
            <slot />
            <i class="fa-solid fa-sort"></i>
        </div>
    </th>
</template>
