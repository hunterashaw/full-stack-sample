<!DOCTYPE html><html><head><title>Sample Full-Stack Project</title><link rel="stylesheet" href="style.css"><script src="vue.js"></script></head><body><div id="app"><div id="search"><i @click="results=[];searchText=''">{{(searchText == '')?'search':'close'}}</i><input placeholder="search buyer names" @input="search()" v-model="searchText"></div><div id="results" v-show="results.length &gt; 0"><div class="buyer header"><span class="id">ID</span><span class="name">Buyer Name</span><span class="budget">Budget</span></div><div class="buyer" v-for="buyer in results"><span class="id">{{buyer.ID}}</span><span class="name">{{buyer.Name}}</span><span class="budget">${{buyer.Budget}}</span></div></div></div><script>/* Utility function for API calls */

function debounce(func, delay){ 
    let timer
    return function(){
        const context = this
        const args = arguments 
        clearTimeout(timer) 
        timer = setTimeout(function(){func.apply(context, args)}, delay) 
    } 
}

/* Generic new Buyer definition */

function Buyer(){
    this.ID = undefined
    this.Name = ''
    this.Budget = undefined
}

/* Client-Side Controller */

function BuyerController(){
    this.load = async function(ID){
        let tmp = await fetch('/model/buyer?ID=' + ID)
        let result = await tmp.json()
        return result
    }
    this.save = async function(buyer){
        let tmp = await fetch('/model/buyer', {method:'POST', body:JSON.stringify(buyer)})
        if (await tmp.json() == 1)
            return true
        else
            return false
    }
    this.delete = async function(ID){
        let tmp = await fetch('/model/buyer?ID=' + ID, {method:'DELETE'})
        if (await tmp.json() == 1)
            return true
        else
            return false
    }
    this.search = async function(text){
        if (isNaN(text)){
            let tmp = await fetch('/model/buyer?Name=' + text)
            let result = await tmp.json()
            return result

        } else {
            let tmp = await fetch('/model/buyer?ID=' + text)
            let result = await tmp.json()
            return result
        }
    }
}let controller = new BuyerController()

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
})</script></body></html>