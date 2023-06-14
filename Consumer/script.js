const energyData = {
    kitchen: 25,
    livingRoom: 40,
    bedroom: 15,
    entryway: 10,
  };
  
  // Çark grafiği 
  function createDonutChart() {
    const ctx = document.getElementById('donut-chart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: Object.keys(energyData),
        datasets: [
          {
            data: Object.values(energyData),
            backgroundColor: [
              'rgb(78, 147, 58)',
              'rgb(46, 44, 99)',
              'rgb(106, 45, 111)',
              'rgb(58, 147, 142)',
            ],
          },
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom',
        },
      },
    });
  }
  
  // Günlere göre enerji harcaması grafiği 
  function createBarChart() {
    const ctx = document.getElementById('bar-chart').getContext('2d');
    const chart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
        datasets: [
          {
            label: 'Kitchen',
            backgroundColor: 'rgb(78, 147, 58)',
            data: [30, 45, 20, 35, 40, 30, 25],
          },
          {
            label: 'Living Room',
            backgroundColor: 'rgb(46, 44, 99)',
            data: [25, 30, 45, 20, 15, 35, 30],
          },
          {
            label: 'Bedroom',
            backgroundColor: 'rgb(106, 45, 111)',
            data: [20, 25, 30, 45, 35, 20, 15],
          },
          {
            label: 'Entryway',
            backgroundColor: 'rgb(58, 147, 142)',
            data: [15, 20, 25, 30, 25, 20, 35],
          },
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom',
        },
        scales: {
          x: {
            stacked: true,
          },
          y: {
            stacked: true,
          },
        },
      },
    });
  }
  

  document.addEventListener('DOMContentLoaded', () => {
    createDonutChart();
    createBarChart();

  });
  
  