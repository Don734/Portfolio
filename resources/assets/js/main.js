import Chart from "chart.js/auto";
import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
  const dataTable = document.querySelectorAll('.data-table');
  if (dataTable.length) {
    initDataTable();
  }
  chartInit();
  customSelect();
;});

function initDataTable() {
  const table = $('table.data-table');
  const searchForm = $('.search-form #search');
  const perPage = $('.showing-form #showing');
  const pagination = $('.pagination');
  let dataTable = table.DataTable({
    "dom": 'rt',
    columnDefs: [
      {
        orderable: false,
        targets: 'no-sort'
      },
      {
        render: DataTable.render.select(),
        targets: 'selectable'
      }
    ],
    select: {
      style: 'multi',
      selector: 'td:first-child',
    },
    order: [[1, 'asc']],
    autoWidth: false
  });
}

function chartInit() {
  const chartLine = document.getElementById("lineChart");
  const chartBar = document.getElementById("barChart");
  const chartBar2 = document.getElementById("barChart2");
  const pieChart = document.getElementById("pieChart");
  
  const chartLineOptions = {
    type: 'line',
    data: {
      labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUB', 'JUL'],
      datasets: [
        {
          label: 'My First Dataset',
          data: [14, 47, 50, 15, 49, 76, 66],
          borderColor: "#4318FF",
        },
        {
          label: 'My Second Dataset',
          data: [10, 24, 37, 42, 32, 23, 34],
          borderColor: "#6AD2FF",
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      fill: false,
      tension: 0.4,
      backgroundColor: 'transparent',
      pointBorderWidth: 1,
      pointBackgroundColor: '#ffffff',
      pointRadius: 4,
      scales: {
        x: {
          display: true,
          grid: {
            display: false,
          },
        },
        y: {
          display: false,
          max: 100
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    },
  }

  const chartBarOptions = {
    type: 'bar',
    data: {
      labels: ['17', '16', '18', '19', '20', '21', '22', '23'],
      datasets: [
        {
          data: [81, 121, 40, 52, 164, 113, 26, 68],
          backgroundColor: "#775FFC",
        },
        {
          data: [135, 182, 76, 112, 199, 168, 49, 120],
          backgroundColor: "#84D9FD"
        },
        {
          data: [135, 182, 76, 112, 199, 168, 49, 120],
          backgroundColor: "#E6EDF9"
        }
      ],
    },
    options: {
      responsive: true,
      barPercentage: 0.3,
      scales: {
        x: {
          stacked: true,
          grid: {
            display: false,
          }
        },
        y: {
          stacked: true,
          display: false,
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    },
  }

  const chartBarOptions2 = {
    type: 'bar',
    data: {
      labels: ['17', '16', '18', '19', '20', '21', '22'],
      datasets: [
        {
          data: [81, 121, 40, 52, 164, 113, 26],
          backgroundColor: "#775FFC",
        }
      ],
    },
    options: {
      responsive: true,
      barPercentage: 0.5,
      scales: {
        x: {
          stacked: true,
          grid: {
            display: false,
          }
        },
        y: {
          stacked: true,
          display: false,
        }
      },
      plugins: {
        legend: {
          display: false
        }
      }
    },
  }

  const chartPieOptions = {
    type: 'pie',
    data: {
      labels: [
        'First',
        'Second',
        'Third'
      ],
      datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
          "#4318FF",
          '#6AD2FF',
          '#EFF4FB'
        ],
        hoverOffset: 4,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom',
          labels: {
            boxWidth: 8,
            boxHeight: 8,
            usePointStyle: true,
          }
        }
      }
    },
  }

  if (chartLine) {
    new Chart(chartLine, chartLineOptions);
  }

  if (chartBar) {
    new Chart(chartBar, chartBarOptions);
  }

  if (chartBar2) {
    new Chart(chartBar2, chartBarOptions2);
  }

  if (pieChart) {
    new Chart(pieChart, chartPieOptions);
  }
}

function customSelect() {
  const select = $('.custom-select');

  if (select.length > 0) {
      select.select2({
          theme: 'custom'
      });
  }
}