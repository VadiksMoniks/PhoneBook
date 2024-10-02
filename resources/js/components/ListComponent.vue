<template>
  <div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Phone Book</h1>
    
    <div class="mb-4 flex justify-center">
      <input v-model="pattern" @keyup="search_contacts()"
        type="text"
        placeholder="Search for number or person"
        class="w-full max-w-md px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
      />
    <div v-if="result_list_visibility" class="absolute mt-8 bg-white shadow-lg rounded-lg w-full max-w-md z-10">
        <div @click="get_contact(record)" v-if="Array.isArray(search_results)" v-for="record in search_results" class="border-b border-gray-200 p-4 hover:bg-gray-100 transition duration-200">
            <div class="font-semibold text-gray-800">{{ record.last_name }} {{ record.first_name }}</div>
            <div class="text-sm text-gray-500">{{ record.phone_number }}</div>
        </div>
        <div v-else class="p-4 text-sm text-gray-500">
            {{ search_results }}
        </div>
    </div>
    </div>

    <div class="text-center mb-16">
      <button
        @click="closeForm(false, null)"
        class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        Add Contact
      </button>
    </div>

    <div class="mb-6 ">
      <div
        v-for="record in records"
        :key="record.id"
        class="bg-white p-4 mb-2 border border-gray-200 rounded-md shadow-sm flex items-center justify-between hover:cursor-pointer hover:border-indigo-700"
      >
        <div class="flex flex-col">
          <div class="text-lg whitespace-nowrap font-semibold">{{ record.last_name }}, {{ record.first_name }}</div>
          <div class="text-gray-600 whitespace-nowrap">{{ record.phone_number }}</div>
        </div>
        <div class="w-full flex justify-end gap-4">
          <button @click="closeForm(true, record)" class="text-green-400 hover:text-green-500">Edit</button>
          <button @click="delete_contact(record.id)"class="text-red-400 hover:text-red-500">Delete</button>
        </div>
      </div>
<div class="flex justify-center space-x-4 mt-8">
  <div v-if="this.prev_page != null">
    <button 
      @click="get_next_page(prev_page)"
      class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    >
      Prev
    </button>
  </div>
  <div v-if="this.next_page != null">
    <button 
      @click="get_next_page(next_page)"
      class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500"
    >
      Next
    </button>
  </div>
</div>
    </div>

    <div v-if="this.addForm">
      <AddFormComponent
      :closeForm=closeForm
      :edit_contact="edit_contact"
      :edit_data="edit_data"
      >
      </AddFormComponent>
    </div>

    <div v-if="contact_window">
      <ContactInfoComponent
      :contact="contact_info"
      :close_contact_window="close_contact_window">
      </ContactInfoComponent>
    </div>
  </div>
</template>
<script>
import axios from 'axios'
import AddFormComponent from './AddFormComponent.vue'
import ContactInfoComponent from './ContactInfoComponent.vue'
export default{
    data(){
        return {
            records: null,
            search_results: null,
            result_list_visibility: false,
            pattern: '',
            addForm: false,
            contact_window: false,
            contact_info: null,
            edit_contact: false,
            edit_data: null,
            next_page: null,
            prev_page: null,
        }
    },

    components:{
      AddFormComponent, ContactInfoComponent
    },

    mounted(){
        this.get_records();
    },

    methods:{
        get_records(){
            axios.get('http://localhost/test/public/phonebook/list')
            .then( response => {
                console.log(response.data);
                this.records = response.data.data;
                this.prev_page = response.data.links.prev;
                this.next_page = response.data.links.next;
            })
            .catch()
        },

        get_next_page(direction){
          axios.get(direction)
            .then( response => {
                console.log(response.data);
                this.records = response.data.data;
                this.prev_page = response.data.links.prev;
                this.next_page = response.data.links.next;
            })
            .catch()
        },

        closeForm(value, data){
          this.addForm = !this.addForm;
          this.edit_contact = value;
          this.edit_data = data;
        },

        search_contacts(){
          if(this.pattern.trim() !== ''){
            axios.get("http://localhost/test/public/phonebook/contacts/"+this.pattern)
            .then( response => {
              this.search_results = response.data.data;
              this.result_list_visibility = true;
              console.log(response.data.results);
            })
          }
          else{
            this.result_list_visibility = false;
            this.search_results = null;
          }
        },

        get_contact(contact){
          this.contact_info = contact;
          this.close_contact_window();
        },

        close_contact_window(){
          this.contact_window = !this.contact_window;
        },

        delete_contact(id){
          console.log(id);
          axios.delete('http://localhost/test/public/phonebook/'+id+'/delete')
          .then( response => {
            alert(response.data.data.message);
          })
          .catch( error => {
            alert(error.response.data.message);
          })
        }
    }
}
</script>