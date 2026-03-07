import DataTable from "datatables.net-dt"

const tableState = {
  draw: 0,
  start: 0,
  length: 10,
  search: '',
  orderColumn: 0,
  orderDir: 'asc',
  totalRecords: 0,
  filteredRecords: 0,
  selectedRows: new Set()
};

let debounceTimer = null;

document.addEventListener('DOMContentLoaded', () => {
  const dataTable = document.querySelectorAll('.data-table');
  if (dataTable.length) {
    initDataTable();
  }
});

function initDataTable() {
    const table = document.querySelector('table.data-table');
    if (!table) return;

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
        pageLength: 10,
        lengthChange: false,
    });
    const searchInput = document.querySelector('.search-form #search');
    const perPageSelect = document.querySelector('.showing-form #showing');

    if (searchInput) {
        searchInput?.addEventListener('keyup', (e) => {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                tableState.search = e.target.value;
                tableState.start = 0;
                loadData(table);
            }, 300);
        })
    }
    
    if (perPageSelect) {
        perPageSelect.addEventListener('change', (e) => {
            tableState.length = parseInt(e.target.value, 10);
            tableState.start = 0;
            loadData(table);
        });
    }

    table.addEventListener('change', (e) => {
        if (e.target.type === 'checkbox') {
            handleRowSelect(e.target);
        }
    });

    loadData(table);
}