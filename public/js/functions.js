export const showAlert = (message, type, alert) => {
  alert.innerHTML = `${message}`
  alert.classList.add(type)
  setTimeout(() => {
    alert.classList.remove(type)
    setTimeout(() => {
      alert.innerHTML = ''
    }, 500)
  }, 5000)
}
