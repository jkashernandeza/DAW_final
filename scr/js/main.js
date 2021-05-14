var save = true;

function editPreorder(){
    if(save){
        document.getElementById("edit_preorder").innerHTML="save";
        if(document.getElementById("name1")!=null)document.getElementById("name1").readOnly=false;
        if(document.getElementById("name2")!=null)document.getElementById("name2").readOnly=false;
        if(document.getElementById("song")!=null)document.getElementById("song").readOnly=false;
        if(document.getElementById("date")!=null)document.getElementById("date").readOnly=false;
        if(document.getElementById("text_sh")!=null)document.getElementById("text_sh").readOnly=false;
        if(document.getElementById("text_lg")!=null)document.getElementById("text_lg").readOnly=false;
    }else{
        document.getElementById("edit_preorder").innerHTML="mode_edit";
        if(document.getElementById("name1")!=null){aux=document.getElementById("name1");aux.readOnly=true;}
        if(document.getElementById("name2")!=null){aux=document.getElementById("name2");aux.readOnly=true;}
        if(document.getElementById("song")!=null){aux=document.getElementById("song");aux.readOnly=true;}
        if(document.getElementById("date")!=null){aux=document.getElementById("date");aux.readOnly=true;}
        if(document.getElementById("text_sh")!=null){aux=document.getElementById("text_sh");aux.readOnly=true;}
        if(document.getElementById("text_lg")!=null){aux=document.getElementById("text_lg");aux.readOnly=true;}
    }
    save=!save;
}

function editAddress(){
    if(save){
        document.getElementById("edit_address").innerHTML="save";
        document.getElementById("receptor").readOnly=false;
        document.getElementById("telefono").readOnly=false;
        document.getElementById("calle").readOnly=false;
        document.getElementById("exterior").readOnly=false;
        document.getElementById("interior").readOnly=false;
        document.getElementById("colonia").readOnly=false;
        document.getElementById("cp").readOnly=false;
        document.getElementById("ciudad").readOnly=false;
        document.getElementById("estado").readOnly=false;
        document.getElementById("pais").readOnly=false;
    }else{
        document.getElementById("edit_address").innerHTML="mode_edit";
        document.getElementById("receptor").readOnly=true;
        document.getElementById("telefono").readOnly=true;
        document.getElementById("calle").readOnly=true;
        document.getElementById("exterior").readOnly=true;
        document.getElementById("interior").readOnly=true;
        document.getElementById("colonia").readOnly=true;
        document.getElementById("cp").readOnly=true;
        document.getElementById("ciudad").readOnly=true;
        document.getElementById("estado").readOnly=true;
        document.getElementById("pais").readOnly=true;
    }
    save=!save;
}


function loginSession(){
    if(1>0)
        var auxxx=0;
}

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')