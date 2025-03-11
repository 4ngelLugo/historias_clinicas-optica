document.addEventListener('DOMContentLoaded', () => {
  const modalRecord = document.getElementById('modalRecord')
  const pacHistoria = document.getElementById('pacHistoria')
  const genHistoria = document.getElementById('genHistoria')
  const motv = document.getElementById('motv')
  const esfod = document.getElementById('esfod')
  const cilod = document.getElementById('cilod')
  const ejeod = document.getElementById('ejeod')
  const esfoi = document.getElementById('esfoi')
  const ciloi = document.getElementById('ciloi')
  const ejeoi = document.getElementById('ejeoi')
  const diaod = document.getElementById('diaod')
  const diaoi = document.getElementById('diaoi')
  const recom = document.getElementById('recom')


  const closeModal = () => {
    modalRecord.classList.add('hidden')
    modalRecord.classList.remove('grid')
  }

  window.openModal = function (recordId) {
    console.log(recordId)

    if (modalRecord) {
      numHistoria.innerText = recordId.hist_id
      pacHistoria.innerText = recordId.pac_nombre + " " + recordId.pac_apellido
      genHistoria.innerText = recordId.gen_nombre
      genHistoria.innerText = recordId.gen_nombre
      motv.innerText = recordId.hist_motv
      esfod.innerText = recordId.hist_esfod
      cilod.innerText = recordId.hist_cilod
      ejeod.innerText = recordId.hist_ejeod
      esfoi.innerText = recordId.hist_esfoi
      ciloi.innerText = recordId.hist_ciloi
      ejeoi.innerText = recordId.hist_ejeoi
      diaod.innerText = recordId.hist_diaod
      diaoi.innerText = recordId.hist_diaoi
      recom.innerText = recordId.hist_recom

      modalRecord.classList.remove('hidden')
      modalRecord.classList.add('grid')
    }
  }

  document.addEventListener('click', (e) => {
    if (e.target === modalRecord) { closeModal() }
  })
})