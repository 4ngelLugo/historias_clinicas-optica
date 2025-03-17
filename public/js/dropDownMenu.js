document.addEventListener('DOMContentLoaded', () => {
  const usersMenuBtn = document.getElementById('usersMenuBtn')
  const usersMenu = document.getElementById('usersMenu')

  if (usersMenuBtn) {
    usersMenuBtn.addEventListener('click', function () {
      usersMenu.classList.toggle('hidden')
      usersMenuBtn.classList.toggle('bg-indigo-50')
      usersMenuBtn.classList.toggle('bg-indigo-500')
      usersMenuBtn.classList.toggle('text-white')
    })
  }

  const pacientsMenuBtn = document.getElementById('pacientsMenuBtn')
  const pacientsMenu = document.getElementById('pacientsMenu')

  if (pacientsMenuBtn) {
    pacientsMenuBtn.addEventListener('click', function () {
      pacientsMenu.classList.toggle('hidden')
      pacientsMenuBtn.classList.toggle('bg-indigo-50')
      pacientsMenuBtn.classList.toggle('bg-indigo-500')
      pacientsMenuBtn.classList.toggle('text-white')
    })
  }

  document.addEventListener('click', function (event) {
    if (usersMenu && !usersMenuBtn.contains(event.target) && !usersMenu.contains(event.target)) {
      usersMenu.classList.add('hidden')
      usersMenuBtn.classList.add('bg-indigo-50')
      usersMenuBtn.classList.remove('bg-indigo-500')
      usersMenuBtn.classList.remove('text-white')
    }

    if (pacientsMenuBtn && !pacientsMenuBtn.contains(event.target) && !pacientsMenu.contains(event.target)) {
      pacientsMenu.classList.add('hidden')
      pacientsMenuBtn.classList.add('bg-indigo-50')
      pacientsMenuBtn.classList.remove('bg-indigo-500')
      pacientsMenuBtn.classList.remove('text-white')
    }
  })
})
