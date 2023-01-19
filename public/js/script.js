// CREATE SUPER CATEGORY
$(document).ready(function(){
    $("#SuperCategoryForm").submit(async function(e){
        e.preventDefault();
        const form = new FormData(e.target);
        const alertBox = document.getElementById("message");
        const response = await fetch("http://localhost:8000/api/sup-category/create",{
            method: "POST",
            body: form
        });
        
        if(!response.ok) ShowMessage(false,"Something went wrong !",alertBox);

        const jsonRes = await response.json();
        ShowMessage(true,"Super category created !",alertBox);
        e.target.reset();
    })
})

// CREATE SUB CATEGORY
$(document).ready(function(){
    $("#SubCategoryForm").submit(async function(e){
        e.preventDefault();
        const form = new FormData(e.target);
        const alertBox = document.getElementById("subMessage");
        const response = await fetch("http://localhost:8000/api/sub-category/create",{
            method: "POST",
            body: form
        });
        
        if(!response.ok) ShowMessage(false,"Something went wrong !",alertBox);

        const jsonRes = await response.json();
        ShowMessage(true,"Super category created !",alertBox);
        e.target.reset();
    })
})

// FETCH SUB CATEGORY ACORDING TO SUPER CATEGORY
$(document).ready(function(){
    $("#supcategory").change(async function(){
        const alertBox = document.getElementById("childMessage");
        let subcategory = document.querySelector("#subcategory");

        subcategory.innerHTML = '<option value="">Select Sub category</option>';
        const id = this.value;
        if(id == "") return;
        const response = await fetch(`http://localhost:8000/api/sub-category/${id}`);
        if(response.ok) {
            let jsonRes = await response.json();
            if(jsonRes.child == null) return ShowMessage(false,jsonRes.message,alertBox);

            jsonRes.child.forEach(function(_supChild){
                const option = document.createElement("OPTION");
                option.innerHTML = _supChild.name;
                option.value = _supChild.id;
                subcategory.append(option)
            })
        }
        else {
            let errorRes = await response.text();
            ShowMessage(false,"Something went wrong !",alertBox);
        }
    })
})

// CREATE ITEM FUNCTION
$(document).ready(function(){
    $("#ItemForm").submit(async function(e){
        e.preventDefault();
        const form = new FormData(e.target);
        const alertBox = document.getElementById("childMessage");
        const response = await fetch("http://localhost:8000/api/create",{
            method: "POST",
            body: form
        });
        
        if(!response.ok) ShowMessage(false,"Something went wrong !",alertBox);

        const jsonRes = await response.json();
        ShowMessage(true,"Super category created !",alertBox);
        e.target.reset();
    })
})

function ShowMessage(isSuccess,message,element) {
    isSuccess ? ReplaceClass("alert-danger","alert-success",element) : ReplaceClass("alert-success","alert-danger",element);
    element.innerHTML = message;

    setTimeout(()=>{
        let currentClass = isSuccess ? "alert-success" : "alert-danger";
        element.innerHTML = "";
        ReplaceClass(currentClass,null,element);
    },3000)
}

function ReplaceClass(remove,add,element) {
    element.classList.remove(remove);
    add && element.classList.add(add);
}