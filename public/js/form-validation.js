( function () {
  'use strict'

      const form = document.getElementById('form-Validation');

      form.addEventListener('submit', function (event) {
        
        if (!form.checkValidity()) 
        {
          event.preventDefault()

          form.classList.add('was-validated')
          
        }

      }, false)

      

})()