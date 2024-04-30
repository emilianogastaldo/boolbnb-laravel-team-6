   // Prendo i campi dal DOM
   const form = document.getElementById('form');

   // Campi
   const title = document.getElementById('title')
   const address = document.getElementById('input-address')
   const room = document.getElementById('room')
   const bed = document.getElementById('bed')
   const bathroom = document.getElementById('bathroom')
   const sq = document.getElementById('sq_m')
   const description = document.getElementById('description')
   const image = document.getElementById('image');

   // Alerts
   const titleAlert = document.getElementById('title-alert')
   const addressAlert = document.getElementById('address-alert')
   const roomAlert = document.getElementById('room-alert')
   const bedAlert = document.getElementById('bed-alert')
   const bathAlert = document.getElementById('bathroom-alert')
   const sqAlert = document.getElementById('sq-alert')
   const imageAlert = document.getElementById('image-alert')
   const descriptionAlert = document.getElementById('description-alert')


   // Faccio un addEventListenter al submit del form
   form.addEventListener('submit', (e) => {
       // Impedisco il comportamento naturale del form
       console.log("cliccato");
       e.preventDefault();

       const titleValue = title.value.trim();
       const addressValue = address.value.trim();
       const roomValue = room.value.trim();
       const bedValue = bed.value.trim();
       const bathroomValue = bathroom.value.trim();
       const sqValue = sq.value.trim();
       const descriptionValue = description.value.trim();
       const imageValue = image.value;

       if(!titleValue){
           // Compare l'alert
           titleAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           titleAlert.innerText = 'Inserire il nome dell\'appartamento';
       }

       if(!addressValue){
           // Compare l'alert
           roomAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           roomAlert.innerText = 'Inserire il nome dell\'appartamento';
       }
       if(!roomValue){
           // Compare l'alert
           roomAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           roomAlert.innerText = 'Inserire il nome dell\'appartamento';
       }
       if(!bedValue){
           // Compare l'alert
           bedAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           bedAlert.innerText = 'Inserire il nome dell\'appartamento';
       }
       if(!bathroomValue){
           // Compare l'alert
           bathAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           bathAlert.innerText = 'Inserire il nome dell\'appartamento';
       }
       if(!sqValue){
           // Compare l'alert
           sqAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           sqAlert.innerText = 'Inserire il nome dell\'appartamento';
       } 
       if(!descriptionValue){
           // Compare l'alert
           descriptionAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           descriptionAlert.innerText = 'Inserire il nome dell\'appartamento';
       }
       if(!imageValue){
           // Compare l'alert
           imageAlert.classList.remove('d-none');

           // Scrivo il testo dell'alert
           imageAlert.innerText = 'Inserire il nome dell\'appartamento';
       } else{
           form.submit();
       }
   });