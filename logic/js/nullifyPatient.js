import { showAlert } from './functions.js'

document.addEventListener('DOMContentLoaded', () => {
  const modalNullify = document.getElementById('modalNullify')
  const modalNullifyCancel = document.getElementById('modalNullifyCancel')
  const modalNullifyAccept = document.getElementById('modalNullifyAccept')
  const modalNullifyText = document.getElementById('modalNullifyText')

  const alert = document.getElementById('alert')

  let selectedPatientId = null

  const closeModalNullify = () => {
    modalNullify.classList.add('hidden')
    modalNullify.classList.remove('grid')
  }

  window.openModal = function (patientId, patientName) {
    selectedPatientId = patientId

    if (modalNullify && modalNullifyText) {
      modalNullifyText.innerHTML =
        `<span>¿Esta seguro que desea anular a este paciente?</span>
        <span><strong>ID: </strong>${patientId}</span>
        <span><strong>Nombre: </strong>${patientName}</span>`

      modalNullify.classList.remove('hidden')
      modalNullify.classList.add('grid')
    }
  }

  document.addEventListener('click', (e) => {
    if (e.target === modalNullify) { closeModalNullify() }
  })

  modalNullifyCancel.addEventListener('click', closeModalNullify)

  modalNullifyAccept.addEventListener('click', () => {
    fetch('../logic/php/nullifyPatient.php', {
      method: 'POST',
      body: new URLSearchParams({ patientId: selectedPatientId })
    })
      .then((res) => res.json())
      .then((response) => {
        if (response.error) {
          switch (response.error) {
            case 'empty fields':
              showAlert('Falta un paciente en la solicitud', 'errorAlert', alert)
              break

            case 'database error':
              showAlert('No se pudo conectar con la base de datos', 'errorAlert', alert)
              break

            case 'nullifying error':
              showAlert('Ocurrió un error al anular el paciente', 'errorAlert', alert)
              break
          }
        } else if (response.success) {
          showAlert('Paciente anulado exitosamente', 'successAlert', alert)
          closeModalNullify()
          setTimeout(() => {
            window.location.reload()
          }, 2000)
        }
      })
      .catch((error) => {
        showAlert('Hubo un problema con la solicitud', 'errorAlert', alert)
        console.error(error)
      })
  })
})
