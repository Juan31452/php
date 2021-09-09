var xhr = new XMLHttpRequest();
xhr.open('GET','registro2.php');
xhr.onload = function()
{  
    if (xhr.status == 200)
    {
        var json = JSON.parse(xhr.responseText);
        
        var template =``;
        json.map(function(data){

        template += `
        
        <h2>${data.Nombre}</h2>
        <h3>Descripcion:</h3>
        <p>${data.Descripcion}</p><br>
        <p>${data.Imagen}</p> 
        <h3>Cantidad:</h3>
        <p>${data.Cantidad}</p>
        <h3>Precio:</h3>
        <p>${data.Valor_Unitario}</p>
       
        
        `;
        return template;
        
    });

    
        
    console.log(template);
    //document.getElementById('principal').innerHTML = template;
    document.getElementById('texto').innerHTML = json[0].Nombre;
    document.getElementById('img').src = json[0].Imagen;
    document.getElementById('descripcion').innerHTML = json[0].Descripcion + "\ud83e\uddd1" + "</b>";
    document.getElementById('precio').innerHTML = json[0].Valor_Unitario;
    
    document.getElementById('texto1').innerHTML = json[1].Nombre;
    document.getElementById('img1').src = json[1].Imagen;
    document.getElementById('descripcion1').innerHTML = json[1].Descripcion + "\ud83e\uddd1" + "</b>";
    document.getElementById('precio1').innerHTML = json[1].Valor_Unitario;
    
   
}else 
    {
    console.log("Error"+xhr.status);  
    }

}    
xhr.send();