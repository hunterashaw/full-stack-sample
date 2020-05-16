/* Utility function for API calls */

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
}