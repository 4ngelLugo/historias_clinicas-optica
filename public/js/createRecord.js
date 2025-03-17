import { showAlert } from './functions.js'

document.addEventListener('DOMContentLoaded', () => {
  const createRecordForm = document.getElementById('createRecord_form')
  const alert = document.getElementById('alert')

  createRecordForm.addEventListener('submit', async (event) => {

    event.preventDefault()

    const formData = new FormData(createRecordForm)

    fetch('../../logic/createRecord.php', {
      method: 'POST',
      body: formData
    })
      .then((res) => res.json())
      .then((response) => {
        if (response.error) {
          switch (response.error) {
            case 'empty fields':
              showAlert('Complete todos los campos', 'errorAlert', alert)
              break

            case 'database error':
              showAlert('No se pudo conectar con la base de datos', 'errorAlert', alert)
              break

            case 'patient doesnt exists':
              showAlert('El paciente no existe', 'errorAlert', alert)
              break

            case 'creation error':
              showAlert('Ocurrió un error al crear la historia', 'errorAlert', alert)
          }
        } else if (response.success) {
          showAlert('Historia creada exitosamente', 'successAlert', alert)
          setTimeout(() => {
            window.location = '?page=listRecords'
          }, 2000)
        }
      })
      .catch((error) => {
        showAlert('Hubo un problema con la solicitud', 'errorAlert', alert)
        console.error(error)
      })
  })
})
