export const showAlert = (message, type, alert) => {
  alert.innerHTML = `${message}`;
  alert.classList.add(type);
  setTimeout(() => {
    alert.classList.remove(type);
  }, 5000);
}