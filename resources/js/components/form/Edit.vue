
<template>
    <main class="min-h-screen w-full bg-gray-600 mx-auto text-white pt-20 p-4">
        <a type="button" class="text-center inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="/">Home</a>
        <form @submit.prevent="edit"  enctype="multipart/form-data">
            <section class="mx-auto max-w-md space-y-10 flex flex-col">
                <p class="text-4xl text-center">Edit campaign advertising</p>

                <input type="text" v-model="campaign.name" placeholder="Name"  class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />
                <span class="text-red-500" style="margin-top: 4px" v-if="errors.name">{{errors.name[0]}}</span>

                <input type="date" v-model="campaign.from" placeholder="From" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />
                <span class="text-red-500" style="margin-top: 4px" v-if="errors.from">{{errors.from[0]}}</span>

                <input type="date" v-model="campaign.to" placeholder="To" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />
                <span class="text-red-500" style="margin-top: 4px" v-if="errors.to">{{errors.to[0]}}</span>

                <input type="number" v-model="campaign.total" placeholder="Total" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />
                <span class="text-red-500" style="margin-top: 4px" v-if="errors.total">{{errors.total[0]}}</span>

                <input type="number" v-model="campaign.daily_budget" placeholder="Daily Budget" class="placeholder:italic text-lg w-full bg-transparent border-b-2 focus:border-orange-500 outline-none transform duration-300" />
                <span class="text-red-500" style="margin-top: 4px" v-if="errors.daily_budget">{{errors.daily_budget[0]}}</span>

                <input type="file" class="form-control" v-on:change="onChange" >

                <div id="preview">
                    <img v-if="url" :src="url" />
                </div>

                <button :disabled="disableTheButton"  class="bg-orange-600 hover:bg-orange-400 transform duration-300 py-2 font-semibold rounded-sm" :class="disableTheButton ? 'bg-gray-500 hover:bg-gray-400':''">Create</button>

            </section>
        </form>
    </main>
</template>

<script>

export default {
    name: "Edit.vue",
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
            errors: {},
            successMessage: "",
            url: '',
            error: '',
            data : new FormData(),
            disableTheButton: false
        }
    },
    methods:{
         edit(){
             this.disableTheButton = true;
            axios.patch(`http://localhost:8000/api/advertising-campaigns/${this.id}`, this.data).then(response=>{
                return window.location.href = '/'
            }).catch(error=>{
                this.errors = error.data.response;
                this.disableTheButton = false;
            })
        },
        onChange(e) {
            this.campaign.images = e.target.files[0];
            this.data.append('images', this.campaign.images);
            this.url = URL.createObjectURL(this.campaign.images);
        },
        appendData(){
            for (const property in this.campaign) {
                if(this.campaign[property] != '') {
                    this.data.append(`${property}`, this.campaign[property])
                }
            }
        },
    },
    created() {
        this.id = window.location.href.match(/[0-9]+/)['input'].split(/\//)[4];

        axios.get('http://localhost:8000/api/advertising-campaigns/'+ this.id).then(response=>{
                this.campaign = response.data.data
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
