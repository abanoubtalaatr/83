
<template>
    <main class="min-h-screen w-full bg-gray-600 mx-auto text-white pt-20 p-4">
        <a type="button" class="text-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/">Home</a>
            <section class="mx-auto max-w-md space-y-10 flex flex-col">
                <p class="text-4xl text-center">View details campaign advertising</p>

                <input disabled type="text" v-model="campaign.name" placeholder="Name"  class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />

                <input disabled type="date" v-model="campaign.from" placeholder="From" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />

                <input disabled type="date" v-model="campaign.to" placeholder="To" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />

                <input disabled type="number" v-model="campaign.total" placeholder="Total" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />

                <input disabled type="number" v-model="campaign.daily_budget" placeholder="Daily Budget" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />

                <div id="preview">
                    <img v-if="url" :src="url" />
                </div>
            </section>
    </main>
</template>

<script>

export default {
    name: "View.vue",
    data()
    {
        return {
            campaign  : {
                'name': '',
                'from' : '',
                'to' : '',
                'total' : '',
                'daily_budget' : '',
                'images' : ''
            },
        }
    },
    mounted() {
        this.id = window.location.href.match(/[0-9]+/)['input'].split(/\//)[5];

        axios.get('http://localhost:8000/api/advertising-campaigns/'+ this.id)
            .then(response=>{
                this.campaign = response.data.data;
            });
    }
}
</script>

<style scoped>
#preview {
    display: flex;
    justify-content: center;
    align-items: center;
}

#preview img {
    max-width: 100%;
    max-height: 500px;
}
</style>
