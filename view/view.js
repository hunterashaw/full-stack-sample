let controller = new BuyerController()

/* VueJS View Logic */

let app = new Vue({
    el:'#app',
    data:{
        searchText:'',
        results:[]
    },
    methods:{
        search:debounce(async function(){
            if (this.searchText == '')
                this.results = []
            else
                this.results = await controller.search(this.searchText)
        }, 250)
    }
})