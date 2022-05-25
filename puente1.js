var xhr = new XMLHttpRequest();
xhr.open('GET','registro2.php');
xhr.onload = function()
{  
    if (xhr.status == 200)
    {
        var json = JSON.parse(xhr.responseText);
       // console.log(json)
        
        var template =``;
        json.map(function(data){

        template += `
    
       
        <tr>
              <td>${data.Fecha}</td>
              <td>${data.Producto}</td>
              <td>${data.Cantidad}</td>
              <td>${data.Valor_Unitario}</td>
        </tr>
        
        `;
         
        return template;
        
    });

    
        
    console.log(template);
    document.getElementById('datostabla').innerHTML = template;
    //document.getElementById('fecha').innerHTML = "______________";
    //document.getElementById('img').src = json[0].Producto;
    //document.getElementById('descripcion').innerHTML = json[0].Descripcion + "\ud83e\uddd1" + "</b>";
    //document.getElementById('precio').innerHTML = json[0].Valor_Unitario;
    
    //document.getElementById('texto1').innerHTML = json[1].Nombre;
    //document.getElementById('img1').src = json[1].Imagen;
    //document.getElementById('descripcion1').innerHTML = json[1].Descripcion + "\ud83e\uddd1" + "</b>";
    //document.getElementById('precio1').innerHTML = json[1].Valor_Unitario;
    
   
}else 
    {
    console.log("Error"+xhr.status);  
    }

}    
xhr.send();