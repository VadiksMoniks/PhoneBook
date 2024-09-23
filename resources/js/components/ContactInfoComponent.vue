<template>
    <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="shadow-2xl p-8 flex flex-col items-center justify-center space-y-6 bg-white rounded-lg w-full max-w-sm md:max-w-md lg:max-w-lg mx-auto relative">
            <div class="w-full flex justify-end">
                <button @click="close_contact_window">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 transform transition duration-250  hover:scale-150">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-indigo-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
            <div class="text-center space-y-2">
                <div class="text-xl font-semibold text-gray-700">Last Name: {{contact.last_name}}</div>
                <div class="text-lg text-gray-600">First Name: {{contact.first_name}}</div>
                <div class="text-lg text-gray-600">Phone Number: {{contact.phone_number}}</div>
            </div>
        </div>
    </div>
</template>
<script>
    export default{
        props:{
            contact: Object,
            close_contact_window: Function,
        },
    }
</script>