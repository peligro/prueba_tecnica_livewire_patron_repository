document.addEventListener('livewire:init', () => {
    //console log
    Livewire.on('log', () => {
        console.log("hola console log");
    });
    //console log2
    Livewire.on('log2', (event) => {
        console.log(event[0].mensaje);
    });
    //usando parámetros
    Livewire.on('parametros', (event) => {
       alert(`parámetro=${event[0].valor} | valor2=${event[0].valor2}`);
    });
    //swal
    Livewire.on('swal', (event) => {
        Swal.fire({
            title: event[0].title,
            text: event[0].mensaje,
            icon: event[0].icon,
            confirmButtonText:'OK'
          });
     });
     //swalRedirect
    Livewire.on('swalRedirect', (event) => {
        Swal.fire({
            title: event[0].title,
            text: event[0].mensaje,
            icon: event[0].icon,
            confirmButtonText:'OK'
          });
         // window.location=event[0].url;
     });
     //modal
    Livewire.on('modal', (event) => {
        $("#ventana_modal").modal('show');
     });
     //toast
    Livewire.on('toast', (event) => {
        $(document).ready(function(){
            $("#ventana_toast").toast('show');
            $("#ventana_toast").toast({
                delay: 2000
            });
            $("#ventana_toast").addClass(event[0].clase);
            $("#ventana_toast_body").html(`<i class="bi ${event[0].icon}" style="font-size:24px;"></i> ${event[0].mensaje}`);
        });
     });

});
function cerrarSesion(ruta)
{
    Swal.fire({
        title: 'Realmente deseas cerrar tu sesión?',
        icon: 'info',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Si',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'NO'
      }).then((result) => {

        if (result.isConfirmed) {
          window.location=ruta;
        }
      });
}
