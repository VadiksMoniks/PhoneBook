<template>
 <div class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="shadow-2xl p-8 flex flex-col items-center justify-center space-y-6 bg-white rounded-lg w-full max-w-sm md:max-w-md lg:max-w-lg mx-auto relative">
        <div class="w-full flex justify-end">
            <button @click="closeForm">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 transform transition duration-250  hover:scale-150">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div>
            <label for="last_name">Last Name</label><br>
            <input v-model="last_name" type="text" id="last_name"  class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
        </div>
        <div>
            <label for="first_name">First Name</label><br>
            <input v-model="first_name" type="text" id="first_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
        </div>
        <div>
            <label for="phone_number">Phone Number</label><br>
            <input v-model="phone_number" type="text" id="phone_number" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out">
        </div>
        <div v-if="!edit_contact" v-for="(number, index) in additional_numbers" :key="index" class="relative mb-4">
            <input 
            v-model="additional_numbers[index]" 
            type="text" 
            placeholder="add additional number" 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out"
            />
            <button 
            @click="delete_additional_number(index)" 
            class="absolute -translate-x-4 -translate-y-2 bg-gray-300 rounded-full p-2 hover:bg-gray-400 transition duration-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
            </button>
        </div>
        <div v-if="!edit_contact" class="flex items-center space-x-2">
        <label class="text-gray-700 font-semibold">Add Phone Number</label>
        <button @click="add_additional_number" class="flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-indigo-600">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
        </button>
        </div>

        <div v-if="edit_contact == false" class="flex items-center justify-center">
            <button @click="add_record" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700">Add Contact</button>
        </div>
        <div v-else class="flex items-center justify-center">
            <button @click="edit_record" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700">Edit Contact</button>
        </div>
        <div class="text-center">
            {{answer}}
        </div>
    </div>
</div>
</template>
<script>
import axios from 'axios';
export default{

    data(){
        return {
            last_name: null,
            first_name: null,
            phone_number: null,
            additional_numbers: [],
            answer: null,
            validation_errors: [],
        }
    },

    props:{
        closeForm: Function,
        edit_contact: Boolean,
        edit_data: Object,
    },

    mounted(){
        if(this.edit_data != null){
            this.last_name = this.edit_data.last_name;
            this.first_name = this.edit_data.first_name;
            this.phone_number = this.edit_data.phone_number;
        }
    },

    methods:{
        add_record(){
            this.validation_errors = [];
            this.validate_personal_data(this.last_name);
            this.validate_personal_data(this.first_name);
            this.validate_phone_number(this.phone_number);

            if(this.additional_numbers.length > 0){
                this.additional_numbers.forEach(number => {
                    this.validate_phone_number(number);
                });
            }
            if (this.validation_errors.length > 0) {
                this.answer = this.validation_errors.join(' ');
            }
            else{
                const formData = new FormData();
                formData.append('last_name', this.last_name);
                formData.append('first_name', this.first_name);
                formData.append('phone_number', this.phone_number);

                if(this.additional_numbers.length > 0){
                    this.additional_numbers.forEach(number => {
                        formData.append('additional_numbers[]', number); // Добавляем каждый номер с индексом
                    });
                }

                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }

                axios.post('http://localhost/test/public/phonebook/store', formData)
                .then( response => {
                    this.answer = response.data.data.message;

                })
                .catch(error => {
                if (error.response && error.response.status === 422) {
                    this.answer = error.response.data.message;
                } 
                });
            }
        },

        edit_record(){
            this.validation_errors = [];
            this.validate_personal_data(this.last_name);
            this.validate_personal_data(this.first_name);
            this.validate_phone_number(this.phone_number);

            if(this.additional_numbers.length > 0){
                this.additional_numbers.forEach(number => {
                    this.validate_phone_number(number);
                });
            }

            if (this.validation_errors.length > 0) {
                this.answer = this.validation_errors.join(' ');
            }
            else{
                const formData = new FormData();
                formData.append('last_name', this.last_name);
                formData.append('first_name', this.first_name);
                formData.append('phone_number', this.phone_number);

                for (var pair of formData.entries()) {
                    console.log(pair[0]+ ', ' + pair[1]); 
                }

                console.log(this.last_name);
                formData.append('_method', 'PUT');
                axios.post('http://localhost/test/public/phonebook/update', formData)
                .then( response => {
                    this.answer = response.data.data.message;

                })
                .catch(error => {
                if (error.response && error.response.status === 422) {
                    this.answer = error.response.data.message;
                } 
                });
            }
        },

        add_additional_number(){
            this.additional_numbers.push('');
        },

        delete_additional_number(index){
            this.additional_numbers.splice(index, 1);
        },

        validate_personal_data(name){
            if(name == '' || name == null){
                this.validation_errors.push('last name and first name can`t be empty');
            }
        },

        validate_phone_number(phone){
            const phoneNumberPattern = /^\+\d{1,3}-\d{3}-\d{3}-\d{4}$/;

            if (!phoneNumberPattern.test(phone)) {
                this.validation_errors.push('Incorrect phone number. It should be like +38-044-123-4567 where +38 is country code, 044 - city/region code, 123-4567 - unique phone number');
            }
        },
    },
}
</script>