import Chart, { elements } from "chart.js/auto";
import DataTable from "datatables.net-dt"
import TomSelect from "tom-select"
import DnD from "./drop";
import './bootstrap';
import "tom-select/dist/css/tom-select.bootstrap5.min.css";

window.TomSelect = TomSelect;
window.DnD = DnD;

document.addEventListener('DOMContentLoaded', () => {
  const dataTable = document.querySelectorAll('.data-table');
  if (dataTable.length) {
    initDataTable();
  }
  chartInit();
  customSelect();
  DnDForm();
  setCover();
  initTheme();
});

function initDataTable() {
  const table = document.querySelector('table.data-table');

  const dataTable = new DataTable(table, {
    "dom": 'rt',
    columnDefs: [
      {
        orderable: false,
        targets: 'no-sort'
      }
    ],
    select: {
      style: 'multi',
      selector: 'td:first-child',
    },
    order: [[0, 'desc']],
  });
  const searchInput = document.querySelector('.search-form #search');
  const perPageSelect = document.querySelector('.showing-form #showing');

  let ajaxDataTable = {
    _method: "GET",
    _token: document.head.querySelector('meta[name="csrf-token"]').textContent
  }

  searchInput?.addEventListener('keyup', (e) => {
    console.log(e);
    dataTable.search(e.target.value).draw();
  })

  perPageSelect?.addEventListener('change', (e) => {
    console.log(e);
    dataTable.page.len(parseInt(e.target.value, 10)).draw();
  })

  // table.querySelectorAll('th.no-sort').forEach((th) => {
  //   const index = [...th.parentNode.children].indexOf(th);
  // })

  // searchInput.addEventListener('input', (e) => {
  //   dataTable.search(e.target.value);
  // })

  // perPageSelect.addEventListener('change', (e) => {
  //   dataTable.perPage = parseInt(e.target.value, 10);
  //   dataTable.update();
  // })
  // const searchForm = $('.search-form #search');
  // const perPage = $('.showing-form #showing');
  // const pagination = $('.pagination');
  // let dataTable = table.DataTable({
  //   "dom": 'rt',
  //   columnDefs: [
  //     {
  //       orderable: false,
  //       targets: 'no-sort'
  //     },
  //     // {
  //     //   render: DataTable.render.select(),
  //     //   targets: 'selectable'
  //     // }
  //   ],
  //   select: {
  //     style: 'multi',
  //     selector: 'td:first-child',
  //   },
  //   order: [[0, 'desc']],
  //   autoWidth: false
  // });
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
  const elements = document.querySelectorAll('.custom-select')
  console.log(elements);
  
  elements.forEach((el) => {
    if (!el) return;
    console.log(el);
    
    const isMultiple = el.hasAttribute('multiple');
    const canCreate = el.dataset.create === 'true';

    new TomSelect(el, {
      maxItems: isMultiple ? null : 1,
      create: canCreate,
      persist: false,
      allowEmptyOption: !isMultiple,
      placeholder: el.dataset.placeholder || '',
      plugins: isMultiple ? ['remove_button'] : []
    });
  })
}

function DnDForm() {
  const form = document.querySelector('.dropForm');
  const allowedTypes = [
    // images
    "image/jpeg",
    "image/png",
    "image/webp",
    "image/gif",
    "image/svg+xml",
    "image/avif",

    // documents
    "application/pdf",
    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
    "application/vnd.ms-excel",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
    "application/vnd.ms-powerpoint",
    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
    "text/plain",

    // archives
    "application/zip",
    "application/x-zip-compressed",
    "application/x-rar-compressed",
    "application/vnd.rar",
    "application/x-7z-compressed",

    // media
    "video/mp4",
    "video/webm",
    "audio/mpeg"
  ];

  const Drop = new DnD(form, {
    csrf: true,
    allowedTypes: allowedTypes,
  });
}

function setCover() {
  document.addEventListener('click', async (e) => {
    if (!e.target.classList.contains('set-cover-btn')) return;

    const mediaId = e.target.dataset.mediaId;
    const projectId = e.target.closest('[data-project-id]').dataset.projectId;

    try {
      const response = await fetch(`/admin/projects/${projectId}/set-cover/${mediaId}`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').textContent
        }
      });
      return await response.json();
    } catch (e) {
        console.error('Error setting cover:', e);
    }
  });
}

function initTheme() {
  const themeToggle = document.getElementById('theme-toggle');
  const themeIcon = document.getElementById('theme-icon');
  const theme = localStorage.getItem('theme') || 'light';
  const html = document.documentElement;
  html.setAttribute('data-bs-theme', theme);

  function updateIcon() {
    const theme = html.getAttribute('data-bs-theme');
    themeIcon.innerHTML = theme === 'dark' 
      ? '<i class="bi bi-sun-fill"></i>' 
      : '<i class="bi bi-moon-fill"></i>';
  }

  themeToggle.addEventListener('click', function () {
    const current = html.getAttribute('data-bs-theme');
    const newTheme = current === 'light' ? 'dark' : 'light';
    html.setAttribute('data-bs-theme', newTheme);
    localStorage.setItem('theme', newTheme);
    updateIcon();
  });

  updateIcon();
}