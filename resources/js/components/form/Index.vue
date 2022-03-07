<!-- This example requires Tailwind CSS v2.0+ -->
<template>
    <div class="flex flex-col">
        <div class="p-4">
            <h2 class="mx-auto text-center text-indigo-600 text-xl">Advertising Campaigns</h2>
        </div>
        <p v-if="message" class="ml-4 text-success bg-blue-200 w-4/12">{{message}}</p>
        <div class="p-2 text-right">
            <a type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/advertising-campaigns">Create</a>

        </div>
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">From</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">To</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Daily Budget</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Images</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(item, itemIndex) in lists" :key="item.id" :class="item.id % 2 === 0 ? 'bg-gray-50' : 'bg-white'">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ item.name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.from }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.to }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.total }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ item.daily_budget }}
                            </td>
                            <td>
                                <img :src=item.images>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none " :href="'advertising-campaigns/'+item.id">Edit</a>
                                <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none " @click="deleteCamp(item.id)">Delete</button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index.vue",
    data() {
        return {
            lists: {},
            errors: [],
            disableButton: false,
            message : '',
        };
    },
    methods:{
      deleteCamp(id){
          axios.delete(`http://localhost:8000/api/advertising-campaigns/${id}`).then(response=>{
              this.message = 'Advertising Campaign deleted successfully.'
              window.setInterval(this.refresh, 1000);
          })
        },
         refresh() {
             window.location.reload();
        },
        showImage(id) {
            this.show = id
        }
    },
    mounted() {
        axios.get('http://localhost:8000/api/advertising-campaigns').then(response=>{
          this.lists = response.data.data
        })
    }
}
</script>

<style scoped>

</style>
