const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
  type: 'polarArea',
  data: {
    labels: ['Red', 'Green', 'Yellow', 'Grey', 'Blue'],
    datasets: [
      {
        data: [12, 19, 3, 17, 28],
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(75, 192, 192, 0.5)',
          'rgba(255, 205, 86, 0.5)',
          'rgba(201, 203, 207, 0.5)',
          'rgba(54, 162, 235, 0.5)',
        ],
        borderColor: [
          'rgba(255, 99, 132, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(255, 205, 86, 1)',
          'rgba(201, 203, 207, 1)',
          'rgba(54, 162, 235, 1)',
        ],
        borderWidth: 2,
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
      position: 'bottom',
    },
    scale: {
      ticks: {
        beginAtZero: true,
        max: 40,
      },
      reverse: false,
    },
    animation: {
      animateRotate: false,
      animateScale: true,
    },
    title: {
      display: true,
      text: 'My Polar Area Chart',
    },
    elements: {
      arc: {
        borderColor: '#000000',
      },
    },
  },
});

/* --- */

const iconLinks = document.querySelectorAll('.icon-link');

const buttonTexts = {
  'No Visitado': { activo: 'Visitado', inactivo: 'No Visitado' },
  Visitado: { activo: 'No Visitado', inactivo: 'Visitado' },
  'No Favorito': { activo: 'Favorito', inactivo: 'No Favorito' },
  Favorito: { activo: 'No Favorito', inactivo: 'Favorito' },
};

iconLinks.forEach((iconLink) => {
  iconLink.addEventListener('click', (event) => {
    event.preventDefault();

    const spanElement = iconLink.querySelector('span');
    const currentState = spanElement.textContent;

    if (iconLink.classList.contains('activo')) {
      iconLink.classList.remove('activo');
      spanElement.textContent = buttonTexts[currentState].activo;
    } else {
      iconLink.classList.add('activo');
      spanElement.textContent = buttonTexts[currentState].activo;
    }
  });
});
