import { showAlert } from './functions.js'

document.addEventListener('DOMContentLoaded', () => {
  const loginForm = document.getElementById('login_form')
  const alert = document.getElementById('alert')

  loginForm.addEventListener('submit', (event) => {
    event.preventDefault()

    const formData = new FormData(loginForm)

    fetch('./logic/php/login.php', {
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
              showAlert('No se pudó conectar con la base de datos', 'errorAlert', alert)
              break

            case 'invalid credentials':
              showAlert('Credenciales incorrectos', 'errorAlert', alert)
              break
          }
        } else if (response.success) {
          showAlert(`Bienvenido, ${response.userName}`, 'successAlert', alert)
          setTimeout(() => {
            window.location = './pages/mainPage.php'
          }, 2000)
        }
      })
      .catch((error) => {
        showAlert('Hubo un problema con la solicitud', 'errorAlert', alert)
        console.error(error)
      })
  })
})
