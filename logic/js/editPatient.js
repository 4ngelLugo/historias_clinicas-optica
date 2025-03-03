import { showAlert } from "./functions.js"

document.addEventListener('DOMContentLoaded', () => {

  const createPatientForm = document.getElementById('createPatient_form')
  const alert = document.getElementById('alert')

  createPatientForm.addEventListener('submit', async (event) => {

    event.preventDefault()

    const formData = new FormData(createPatientForm)

    fetch('../logic/php/editPatientLogic.php', {
      method: 'POST',
      body: formData
    })
      .then((res) => res.json())
      .then((response) => {
        if (response.error) {
          switch (response.error) {
            case 'empty fields':
              showAlert('Complete todos los campos', 'errorAlert', alert)
              break;

            case 'database error':
              showAlert('No se pudo conectar con la base de datos', 'errorAlert', alert)
              break;

            case 'user already exists':
              showAlert('No existe un paciente con esta id')
              break;

            case 'update error':
              showAlert('Ocurrió un error al editar el paciente', 'errorAlert', alert)
          }
        } else if (response.success) {
          showAlert('Paciente editado', 'successAlert', alert)
          setTimeout(() => {
            window.location.reload()
          }, 2000)
        }
      })
    // .catch((error) => {
    //   showAlert('Hubo un problema con la solicitud', 'errorAlert', alert);
    //   console.error(error);
    // });

  })

})