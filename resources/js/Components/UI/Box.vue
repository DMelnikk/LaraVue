<template>
    <div class="border border-gray-200  rounded-md p-4 shadow-sm">
        <div class="text-gray-500 font-medium mb-1">
            <slot name="header"/>
        </div>
        <slot />
    </div>
</template>
